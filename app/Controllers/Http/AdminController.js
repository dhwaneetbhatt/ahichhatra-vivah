'use strict'

const fs = require('fs')

/** @type {typeof import('@adonisjs/framework/src/Logger')} */
const Logger = use('Logger')

/** @type {typeof import('@adonisjs/framework/src/Config')} */
const Config = use('Config')

/** @type {typeof import('moment')} */
const moment = use('moment')

/** @type {typeof import('./User')} */
const User = use('App/Models/User')

/** @type {typeof import('./ProfileStatusType')} */
const ProfileStatusType = use('App/Models/ProfileStatusType')

class AdminController {

  async index({ auth, request, view }) {
    const { user } = auth
    
    const input = request.input('status')
    const status = await ProfileStatusType.findBy('name', input)
    const profiles = await User.query().where('status_type_id', status.id).paginate()

    const isApproved = await user.isApproved()
    const isAdmin = await user.isAdmin()
    const statusMap = await this.getProfileStatusMap()
    return view.render('pages.approve-profiles', {
        profiles: profiles.toJSON(), user: auth.user,
        isApproved, isAdmin, moment, statusMap
    })
  }

  async getProfileStatusMap() {
    const map = {}
    const statuses = await ProfileStatusType.all()
    for (const row of statuses.rows) {
      map[row.id] = row.name
    }
    return map
  }

  async update({auth, params, request, view }) {
    const input = request.input('status')
    const user = await User.find(params.id)
    
    if (input === 'PURGE') {
      // if user has a custom photo, delete the photo physically
      const id = user.photo.lastIndexOf("/")
      const file = user.photo.substring(id+1)
      if (!file.includes('default')) {
        const photosDir = Config.get('app.imageDir')
        const path = `${photosDir}/${file}`
        Logger.info('User %s has uploaded custom photo at %s, deleting the file', user.email, path)
        fs.unlinkSync(path)
      }
      await user.delete()
    } else {
      const status = await ProfileStatusType.findBy('name', input)
      user.status_type_id = status.id
      await user.save()
    }
    Logger.info('Marked profile %s as %s', user.email, input)
  }

}

module.exports = AdminController

'use strict'

/** @type {typeof import('@adonisjs/framework/src/Logger')} */
const Logger = use('Logger')

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
    return view.render('pages.approve-profiles', {
        profiles: profiles.toJSON(), user: auth.user,
        isApproved, isAdmin, moment
    })
  }

  async update({auth, params, request, view }) {
    const input = request.input('status')
    const user = await User.find(params.id)
    if (input === 'PURGE') {

    } else {
      const status = await ProfileStatusType.findBy('name', input)
      user.status_type_id = status.id
      await user.save()
    }
    Logger.info('Marked profile with id: %s as %s', user.id, input)
  }

}

module.exports = AdminController

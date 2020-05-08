'use strict'

/** @type {typeof import('@adonisjs/framework/src/Logger')} */
const Logger = use('Logger')

/** @type {typeof import('@adonisjs/framework/src/Config')} */
const Config = use('Config')

/** @type {typeof import('moment')} */
const moment = use('moment')

/** @type {typeof import('./User')} */
const User = use('App/Models/User')

/** @type {typeof import('./Role')} */
const Role = use('App/Models/Role')

/** @type {typeof import('./ProfileStatusType')} */
const ProfileStatusType = use('App/Models/ProfileStatusType')

class ProfileController {

  async index({ auth, response, session, view }) {
    const { user } = auth
    
    const isApproved = await user.isApproved()
    const isAdmin = await user.isAdmin()
    if (isApproved) {
      const role = await user.role().fetch()
      const query = User.query().where('status_type_id', user.status_type_id)

      if (role.name === 'user:male') {
        const femaleRole = await Role.findBy('name', 'user:female')
        query.where('role_id', femaleRole.id)
      }
      else if (role.name === 'user:female') {
        const maleRole = await Role.findBy('name', 'user:male')
        query.where('role_id', maleRole.id)
      }

      // do not include admin
      const adminRole = await Role.findBy('name', 'admin')
      query.whereNot('role_id', adminRole.id)

      Logger.debug('query to fetch profiles: "%s"', query)

      const profiles = await query.paginate()
      return view.render('pages.profiles', {
        profiles: profiles.toJSON(), user: auth.user,
        isApproved, isAdmin, moment
      })
    }
    session.flash({ message: 'Please complete your profile. You will be able to see other profiles once your profile is complete and approved.' })
    return response.redirect(`profiles/${user.id}/edit`)
  }

  async view({ auth, params, session, view }) {
    const user = await User.find(params.id)
    const loggedInUser = auth.user

    // disallow same gender views
    const userRole = await user.role().fetch()
    const loggedInUserRole = await loggedInUser.role().fetch()
    if ((userRole.id === loggedInUserRole.id) && (user.id !== loggedInUser.id)) {
      session.flash({ message: 'Unauthorized to view this profile' })
      return view.render('layout.error')
    }

    // simple properties to be displayed in the view
    const properties = [
      { key: 'father_name', display: 'Father\'s Name' },
      { key: 'mother_name', display: 'Mother\'s Name' },
      { key: 'birthplace', display: 'Place of Birth' },
      { key: 'height', display: 'Height' },
      { key: 'current_city', display: 'Current City' },
      { key: 'gotra', display: 'ગોત્ર' },
      { key: 'vatan', display: 'વતન' },
      { key: 'rashi', display: 'રાશી' },
      { key: 'nadi', display: 'નાડી' },
      { key: 'nakshtra', display: 'નક્ષત્ર' },
      { key: 'email', display: 'Email' },
      { key: 'primary_number', display: 'Mobile/Phone Number' },
      { key: 'permanent_address', display: 'Permanent Address' },
      { key: 'education', display: 'Educational Qualification' },
      { key: 'hobbies', display: 'Hobbies' },
      { key: 'job_description', display: 'Job Description' },
      { key: 'salary', display: 'Salary' },
      { key: 'secondary_address', display: 'Office/Other Address' },
      { key: 'secondary_number', display: 'Office/Other Number' }
    ]

    const isApproved = await user.isApproved()
    const isAdmin = await loggedInUser.isAdmin()
    const statusMap = await this.getProfileStatusMap()
    return view.render('pages.profile-info', {
      profile: user, properties, user: loggedInUser,
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

  async edit({ auth, params, session, view }) {
    const user = await User.find(params.id)
    const loggedInUser = auth.user

    // allow only if user is either admin or its own profile
    const loggedInUserRole = await loggedInUser.role().fetch()
    if (loggedInUserRole.name === 'admin' || user.id === loggedInUser.id) {
      const isApproved = await user.isApproved()
      const isAdmin = await loggedInUser.isAdmin()
      return view.render('pages.profile-edit', {
        profile: user, user: loggedInUser,
        isApproved, isAdmin, moment
      })
    }

    session.flash({ message: 'Unauthorized to update this profile' })
    return view.render('layout.error')
  }

  async update({ auth, params, request, response, session, view }) {
    const user = await User.find(params.id)
    const loggedInUser = auth.user

    // disallow edits of other profiles
    const isAdmin = await loggedInUser.isAdmin()
    if (isAdmin || user.id === loggedInUser.id) {

      // updating image if exists
      if (request.file('photo')) {
        const photo = request.file('photo', {
          types: ['image'],
          size: '2mb'
        })
        const filename = `photo_${user.id}.${photo.extname}`
        await photo.move(Config.get('app.imageDir'), {
          name: filename,
          overwrite: true
        })
        user.photo = `/images/profile_photos/${filename}`

      }

      // if admin is making changes, no need for approval.
      // if user is approved, make profile edited, else keep as-is.
      const isProfileApproved = await user.isApproved()
      if (isProfileApproved && !isAdmin) {
        const status = await ProfileStatusType.findBy('name', 'EDITED')
        user.status_type_id = status.id
      }

      // updating user information
      user.merge(request.except(['_csrf', 'id', 'submit', 'photo']))
      await user.save()
      
      session.flash({ success: 'Profile Saved. It Will be visible after approval.' })
      return response.redirect('back')
    }
    session.flash({ message: 'Unauthorized to update this profile' })
    return view.render('layout.error')
  }

}

module.exports = ProfileController

'use strict'

const Logger = use('Logger')

/** @type {typeof import('moment')} */
const moment = use('moment')

/** @type {typeof import('./User')} */
const User = use('App/Models/User')

/** @type {typeof import('./Role')} */
const Role = use('App/Models/Role')

class ProfileController {

  async index({ auth, response, view }) {
    const { user } = auth
    
    const isApproved = await user.isApproved()
    if (isApproved) {
      const role = await user.role().fetch()
      const query = User.query().where('status_type_id', user.status_type_id)

      if (role.name === 'user:male') {
        const femaleRole = await Role.findBy('user:female')
        query.where('role_id', femaleRole.id)
      }
      else if (role.name === 'user:female') {
        const maleRole = await Role.findBy('user:male')
        query.where('role_id', maleRole.id)
      }

      // do not include admin
      const adminRole = await Role.findBy('name', 'admin')
      query.whereNot('role_id', adminRole.id)

      Logger.debug('query to fetch profiles: "%s"', query)

      const profiles = await query.paginate(1)
      return view.render('pages.profiles', { profiles: profiles.toJSON(), user: auth.user, moment })
    }
    else {
      await auth.logout()
      return response.redirect('login')
    }
  }

  async getProfile({auth, params, session, view }) {
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

    return view.render('pages.profile-info', { profile: user, properties, user: loggedInUser, moment })

  }

}

module.exports = ProfileController

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

}

module.exports = ProfileController

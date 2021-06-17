import { HttpContextContract } from '@ioc:Adonis/Core/HttpContext'
import Role from 'App/Models/Role'
import User from 'App/Models/User'
import Logger from '@ioc:Adonis/Core/Logger'
import moment from 'moment'

export default class ProfileController {
  public async index(ctx: HttpContextContract) {
    const { user } = ctx.auth
    if (!user) throw new Error()
    const isApproved = await user.isApproved()
    const isAdmin = await user.isAdmin()

    if (isApproved) {
      const role: Role = await Role.findOrFail(user.roleId)
      const query = User.query().where('status_type_id', user.statusTypeId)

      if (role.name === 'user:male') {
        const femaleRole = await Role.findByOrFail('name', 'user:female')
        query.where('role_id', femaleRole.id)
      } else if (role.name === 'user:female') {
        const maleRole = await Role.findByOrFail('name', 'user:male')
        query.where('role_id', maleRole.id)
      }

      // do not include admin
      const adminRole = await Role.findByOrFail('name', 'admin')
      query.whereNot('role_id', adminRole.id)

      Logger.debug('query to fetch profiles: "%s"', query)

      const profiles = await query.paginate(0, 10)
      return ctx.view.render('pages/profiles', {
        profiles: profiles.toJSON(),
        user,
        isApproved,
        isAdmin,
        moment,
      })
    }
    return ctx.response.redirect(`profiles/${user.id}/edit`)
  }
}

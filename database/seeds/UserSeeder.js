'use strict'

/*
|--------------------------------------------------------------------------
| UserSeeder
|--------------------------------------------------------------------------
|
| Make use of the Factory instance to seed database with dummy data or
| make use of Lucid models directly.
|
*/

/** @type {import('@adonisjs/framework/src/Hash')} */
const Hash = use('Hash')

/** @type {typeof import('./Role')} */
const Role = use('App/Models/Role')

/** @type {typeof import('./ProfileStatusType')} */
const ProfileStatusType = use('App/Models/ProfileStatusType')

/** @type {typeof import('./User')} */
const User = use('App/Models/User')

class UserSeeder {
  async run () {
    const role = await Role.findBy('name', 'admin')
    const status = await ProfileStatusType.findBy('name', 'APPROVED')
    const first = {
      name: 'admin',
      email: 'admin@random.com',
      password: 'fakepassword',
      role_id: role.id,
      status_type_id: status.id
    }
    await User.create(first)
  }
}

module.exports = UserSeeder

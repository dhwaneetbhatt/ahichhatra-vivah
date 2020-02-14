'use strict'

/*
|--------------------------------------------------------------------------
| RoleSeeder
|--------------------------------------------------------------------------
|
| Make use of the Factory instance to seed database with dummy data or
| make use of Lucid models directly.
|
*/

/** @type {import('../../app/Models/Role')} */
const Role = use('App/Models/Role')

class RoleSeeder {
  async run () {
    const admin = new Role()
    admin.name = 'admin'
    await admin.save()

    const maleUser = new Role()
    maleUser.name = 'user:male'
    await maleUser.save()
    
    const femaleUser = new Role()
    femaleUser.name = 'user:female'
    await femaleUser.save()
  }
}

module.exports = RoleSeeder

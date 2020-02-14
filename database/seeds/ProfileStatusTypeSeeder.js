'use strict'

/*
|--------------------------------------------------------------------------
| ProfileStatusTypeSeeder
|--------------------------------------------------------------------------
|
| Make use of the Factory instance to seed database with dummy data or
| make use of Lucid models directly.
|
*/

/** @type {import('../../app/Models/ProfileStatusType')} */
const ProfileStatusType = use('App/Models/ProfileStatusType')

class ProfileStatusTypeSeeder {
  async run () {
    const nw = new ProfileStatusType()
    nw.name = 'NEW'
    await nw.save()

    const incomplete = new ProfileStatusType()
    incomplete.name = 'INCOMPLETE'
    await incomplete.save()
    
    const edited = new ProfileStatusType()
    edited.name = 'EDITED'
    await edited.save()

    const approved = new ProfileStatusType()
    approved.name = 'APPROVED'
    await approved.save()

    const disapproved = new ProfileStatusType()
    disapproved.name = 'DISAPPROVED'
    await disapproved.save()

    const deleted = new ProfileStatusType()
    deleted.name = 'DELETED'
    await deleted.save()
  }
}

module.exports = ProfileStatusTypeSeeder

import BaseSeeder from '@ioc:Adonis/Lucid/Seeder'
import ProfileStatusType from 'App/Models/ProfileStatusType'

export default class ProfileStatusTypeSeeder extends BaseSeeder {
  public async run() {
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
    // Write your database queries inside the run method
  }
}

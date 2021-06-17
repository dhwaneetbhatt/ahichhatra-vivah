import BaseSeeder from '@ioc:Adonis/Lucid/Seeder'
import Role from 'App/Models/Role'

export default class RoleSeeder extends BaseSeeder {
  public async run() {
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

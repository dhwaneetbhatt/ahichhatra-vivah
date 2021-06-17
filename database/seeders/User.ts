import BaseSeeder from '@ioc:Adonis/Lucid/Seeder'
import Role from 'App/Models/Role'
import ProfileStatusType from 'App/Models/ProfileStatusType'
import User from 'App/Models/User'
import { v4 as uuidv4 } from 'uuid'

export default class UserSeeder extends BaseSeeder {
  public async run() {
    const role = await Role.findByOrFail('name', 'admin')
    const status = await ProfileStatusType.findByOrFail('name', 'APPROVED')
    const first = {
      id: uuidv4(),
      name: 'admin',
      email: 'admin@random.com',
      password: 'fakepassword',
      roleId: role.id,
      statusTypeId: status.id,
    }
    await User.create(first)
  }
}

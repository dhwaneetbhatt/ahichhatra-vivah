import BaseSchema from '@ioc:Adonis/Lucid/Schema'

export default class ProfileStatusTypes extends BaseSchema {
  protected tableName = 'profile_status_types'

  public async up() {
    this.schema.createTable(this.tableName, (table) => {
      table.increments('id').primary()
      table.string('name', 100).unique()
      table.timestamps(true, true)
    })
  }

  public async down() {
    this.schema.dropTable(this.tableName)
  }
}

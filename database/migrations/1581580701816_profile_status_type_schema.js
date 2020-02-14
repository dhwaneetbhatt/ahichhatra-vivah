'use strict'

/** @type {import('@adonisjs/lucid/src/Schema')} */
const Schema = use('Schema')

class ProfileStatusTypeSchema extends Schema {
  async up () {
    const exists = await this.hasTable('profile_status_types')
    if (!exists) {
      this.create('profile_status_types', (table) => {
        table.increments('id')
        table.string('name', 100).unique()
        table.timestamps()
      })
    }
  }

  down () {
    this.dropIfExists('profile_status_types')
  }
}

module.exports = ProfileStatusTypeSchema

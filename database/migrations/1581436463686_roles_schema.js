'use strict'

/** @type {import('@adonisjs/lucid/src/Schema')} */
const Schema = use('Schema')

class RolesSchema extends Schema {
  async up () {
    const exists = await this.hasTable('roles')
    if (!exists) {
      this.create('roles', (table) => {
        table.increments('id')
        table.string('name', 100).unique()
        table.timestamps()
      })
    }
  }

  down () {
    this.dropIfExists('roles')
  }
}

module.exports = RolesSchema

'use strict'

/** @type {import('@adonisjs/lucid/src/Schema')} */
const Schema = use('Schema')

class PasswordRemindersSchema extends Schema {
  async up () {
    const exists = await this.hasTable('password_reminders')
    if (!exists) {
      this.create('password_reminders', (table) => {
        table.string('email').index()
			  table.string('token').index()
			  table.timestamp('created_at')
      })
    }
  }

  down () {
    this.dropIfExists('password_reminders')
  }
}

module.exports = PasswordRemindersSchema

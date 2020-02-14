'use strict'

/** @type {import('@adonisjs/lucid/src/Schema')} */
const Schema = use('Schema')

class UsersSchema extends Schema {
  async up () {
    const exists = await this.hasTable('users')
    if (!exists) {
      this.create('users', (table) => {
        // basic columns
        table.increments('id')
        table.string('email').notNullable().unique()
        table.string('password', 64).notNullable()
        table.integer('role_id').unsigned().references('id').inTable('roles');

        // information columns
        table.string('name', 60).notNullable()
        table.string('photo', 100).nullable()
        table.string('father_name', 60).nullable()
        table.string('mother_name', 60).nullable()

        table.date('birthdate').nullable()
        table.string('birthplace', 30).nullable()
        table.time('birthtime').nullable()
        table.string('height', 10).nullable()

        table.string('gotra', 20).nullable()
        table.string('vatan', 20).nullable()
        table.string('nakshtra', 20).nullable()
        table.string('nadi', 20).nullable()
        table.string('rashi', 20).nullable()

        table.string('permanent_address', 1024).nullable()
        table.string('primary_number', 15).nullable()
        table.string('secondary_address', 1024).nullable()
        table.string('secondary_number', 50).nullable()

        table.string('education', 100).nullable()
        table.string('hobbies', 256).nullable()
        table.string('job_description', 1024).nullable()
        table.string('salary', 20).nullable()
        table.string('references', 1024).nullable()

        // admin related columns
        table.boolean('approved').defaultTo(false)
        table.boolean('visibility').defaultTo(false)

        // managed by framework
        table.timestamps()
        table.string('remember_token', 100).nullable()
      })
    }
  }

  down () {
    this.dropIfExists('users')
  }
}

module.exports = UsersSchema

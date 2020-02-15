'use strict'

/** @type {import('@adonisjs/framework/src/Hash')} */
const Hash = use('Hash')

/** @type {typeof import('@adonisjs/lucid/src/Lucid/Model')} */
const Model = use('Model')

/** @type {typeof import('./ProfileStatusType')} */
const ProfileStatusType = use('App/Models/ProfileStatusType')

class User extends Model {
  static boot() {
    super.boot()

    /**
     * A hook to hash the user password before saving
     * it to the database.
     */
    this.addHook('beforeSave', async (userInstance) => {
      if (userInstance.dirty.password) {
        userInstance.password = await Hash.make(userInstance.password)
      }
    })
  }

  /**
   * A relationship on tokens is required for auth to
   * work. Since features like `refreshTokens` or
   * `rememberToken` will be saved inside the
   * tokens table.
   */
  tokens() {
    return this.hasMany('App/Models/Token')
  }

  role() {
    return this.hasOne('App/Models/Role', 'role_id', 'id')
  }

  status() {
    return this.hasOne('App/Models/ProfileStatusType', 'status_type_id', 'id')
  }

  /**
   * @return true, if user is an admin user
   */
  async isAdmin() {
    const role = await this.role().fetch()
    return role.name === 'admin'
  }

  /**
   * @return true, if user's profile is approved
   */
  async isApproved() {
    const status = await this.status().fetch()
    return status.name === 'APPROVED'
  }

  /**
   * @return true, if user is allowed to login
   */
  async canLogin() {
    const ids = await ProfileStatusType
      .query()
      .where('name', 'in', ['NEW', 'DISAPPROVED', 'DELETED'])
      .ids()
    return !ids.includes(this.status_type_id)

  }

}

module.exports = User

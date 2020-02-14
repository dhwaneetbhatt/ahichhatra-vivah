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
    return this.hasOne('App/Models/Role', 'id', 'role_id')
  }

  status() {
    return this.hasOne('App/Models/ProfileStatusType', 'id', 'status_type_id')
  }

  /**
   * @return true, if user is allowed to login
   */
  async canLogin() {
    return Promise.all([
      ProfileStatusType.findBy('name', 'NEW'),
      ProfileStatusType.findBy('name', 'DISAPPROVED'),
      ProfileStatusType.findBy('name', 'DELETED')
    ]).then(models => models.map(md => md.id))
      .includes(this.status_type_id)
  }
}

module.exports = User

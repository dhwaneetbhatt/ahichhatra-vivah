import { DateTime } from 'luxon'
import Hash from '@ioc:Adonis/Core/Hash'
import { column, beforeSave, BaseModel, belongsTo, BelongsTo } from '@ioc:Adonis/Lucid/Orm'
import Role from 'App/Models/Role'
import ProfileStatusType from 'App/Models/ProfileStatusType'

export default class User extends BaseModel {
  @column({ isPrimary: true })
  public id: string

  @column()
  public email: string

  @column({ serializeAs: null })
  public password: string

  @column()
  public name: string

  @column()
  public photo: string

  @column()
  public fatherName: string

  @column()
  public motherName: string

  @column()
  public birthdate: Date

  @column()
  public birthplace: string

  @column()
  public birthtime: DateTime

  @column()
  public height: string

  @column()
  public gotra: string

  @column()
  public vatan: string

  @column()
  public nakshtra: string

  @column()
  public nadi: string

  @column()
  public rashi: string

  @column()
  public permanentAddress: string

  @column()
  public primaryNumber: string

  @column()
  public secondaryAddress: string

  @column()
  public secondaryNumber: string

  @column()
  public education: string

  @column()
  public hobbies: string

  @column()
  public jobDescription: string

  @column()
  public salary: string

  @column()
  public references: string

  @column()
  public roleId: number

  @column()
  public statusTypeId: number

  @column.dateTime({ autoCreate: true })
  public createdAt: DateTime

  @column.dateTime({ autoCreate: true, autoUpdate: true })
  public updatedAt: DateTime

  @column()
  public rememberMeToken?: string

  @belongsTo(() => Role, { foreignKey: 'roleId' })
  public role: BelongsTo<typeof Role>

  @belongsTo(() => ProfileStatusType, { foreignKey: 'statusTypeId' })
  public status: BelongsTo<typeof ProfileStatusType>

  @beforeSave()
  public static async hashPassword(user: User) {
    if (user.$dirty.password) {
      user.password = await Hash.make(user.password)
    }
  }

  /**
   * @return true, if user is an admin user
   */
  public async isAdmin() {
    const role = await Role.query().where('id', this.roleId).firstOrFail()
    return role.name === 'admin'
  }

  /**
   * @return true, if user's profile is approved
   */
  public async isApproved() {
    const status = await ProfileStatusType.query().where('id', this.statusTypeId).firstOrFail()
    return status.name === 'APPROVED'
  }

  /**
   * @return true, if user is allowed to login
   */
  public async canLogin() {
    const types = await ProfileStatusType.query()
      .where('name', 'in', ['NEW', 'DISAPPROVED', 'DELETED'])
      .select('id')
    return !types.map((p) => p.id).includes(this.statusTypeId)
  }
}

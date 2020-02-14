'use strict'

/** @type {typeof import('./Role')} */
const Role = use('App/Models/Role')

/** @type {typeof import('./User')} */
const User = use('App/Models/User')

class RegisterController {
  
  index({ view }) {
    return view.render('pages.register')
  }

  async register({ request, response, session }) {
    const user = new User()

    const gender = request.input('gender')
    const role = await Role.findBy('name', `user:${gender}`)
    user.role_id = role.id

    user.name = request.input('name')
    user.email = request.input('email')
    user.primary_number = request.input('primary_number')
    user.birthdate = request.input('birthdate')
    user.password = request.input('password')

    // set default profile picture
    user.photo = `/images/profile_photos/default_${gender}.png`

    user.save()
    session.flash({ success: 'Registered succesfully. You will be able to login when admin approves your profile.' })
    return response.redirect('login')
  }

}

module.exports = RegisterController

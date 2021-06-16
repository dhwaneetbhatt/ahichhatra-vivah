'use strict'

/** @type {typeof import('@adonisjs/persona/src/Persona')} */
const Persona = use('Persona')

class PasswordController {

  forgot({ view }) {
    return view.render('pages.forgot-password')
  }

  async reset({ request }) {
    const result = await Persona.forgotPassword(request.input('email'))
    return result
  }

}

module.exports = PasswordController;

'use strict'

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Http routes are entry points to your web application. You can create
| routes for different URL's and bind Controller actions to them.
|
| A complete guide on routing is available here.
| http://adonisjs.com/docs/4.1/routing
|
*/

/** @type {typeof import('@adonisjs/framework/src/Route/Manager')} */
const Route = use('Route')

Route.get('/', async ({ auth, response }) => {
  try {
    await auth.check()
    return response.redirect('home')
  } catch (e) {
    return response.redirect('login')
  }
})

// Those routes should be only accessible
// when you are not logged in
Route.group(() => {
  Route.get('login', 'AuthController.index')
  Route.post('login', 'AuthController.login')

  Route.get('register', 'RegisterController.index')
  Route.post('register', 'RegisterController.register').validator('User')
}).middleware(['guest'])

// Those routes should be only accessible
// when you are logged in
Route.group(() => {
  Route.get('logout', 'AuthController.logout')

  Route.get('home', ({ response }) => response.redirect('profiles'))

  Route.get('profiles', 'ProfileController.index')

}).middleware(['auth'])

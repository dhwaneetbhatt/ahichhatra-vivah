/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| This file is dedicated for defining HTTP routes. A single file is enough
| for majority of projects, however you can define routes in different
| files and just make sure to import them inside this file. For example
|
| Define routes in following two files
| ├── start/routes/cart.ts
| ├── start/routes/customer.ts
|
| and then import them inside `start/routes.ts` as follows
|
| import './routes/cart'
| import './routes/customer''
|
*/

import Route from '@ioc:Adonis/Core/Route'

Route.get('/', async ({ auth, response }) => {
  try {
    await auth.check()
    return response.redirect('home')
  } catch (e) {
    return response.redirect('login')
  }
})

Route.group(() => {
  Route.get('login', 'AuthController.index')
  Route.post('login', 'AuthController.login')
})

Route.group(() => {
  Route.get('home', ({ response }) => response.redirect('profiles'))

  Route.get('profiles', 'ProfileController.index')
}).middleware('auth')

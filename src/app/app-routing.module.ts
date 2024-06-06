import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { LoginComponent } from './pages/login/login.component';
import { authGuard } from './guards/auth.guard';

const routes: Routes = [
  {path:'',component:HomeComponent,pathMatch:'full'},
// {path:'',component:HomeComponent,redirectTo:'home', pathMatch:'full'},
{path:'home',component:HomeComponent},
 { path: 'food', loadChildren: () => import('./pages/foods/foods.module').then(m => m.FoodsModule) },
  { path: 'admin', loadChildren: () => import('./pages/admin/admin.module').then(m => m.AdminModule),canActivate:[authGuard]},
  {path:'login',component:LoginComponent},
{path:'**',component:PageNotFoundComponent}];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

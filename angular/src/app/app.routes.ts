import { Routes } from '@angular/router';
import { authGuard } from './core/auth.guard';
import { DashboardComponent } from './pages/dashboard/dashboard.component';

export const routes: Routes = [
  {
    path: 'auth',
    loadComponent: () => import('./pages/auth/login.component').then(m => m.LoginComponent)
  },
  {
    path: '',
    component: DashboardComponent,
    canActivate: [authGuard],
    children: [
      {
        path: 'users',
        loadComponent: () => import('./pages/users/user-list.component').then(m => m.UserListComponent),
        canActivate: [authGuard]
      },
      {
        path: 'users/edit/:id',
        loadComponent: () => import('./pages/users/user-edit/user-edit.component').then(m => m.UserEditComponent),
        canActivate: [authGuard]
      },
      {
        path: 'profiles',
        loadComponent: () => import('./pages/profiles/profile-list.component').then(m => m.ProfileListComponent),
        canActivate: [authGuard]
      }
    ]
  },
  { path: '', redirectTo: 'auth', pathMatch: 'full' }
];

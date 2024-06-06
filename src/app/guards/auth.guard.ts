import { CanActivateFn } from '@angular/router';

export const authGuard: CanActivateFn = (route, state) => {
  let token=localStorage.getItem('token');
  // if(!token){
  //   alert('Please login to view this page');
  //   return false;

  // }
  return true;
};

import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UserApiService {

  constructor(private http:HttpClient) {}
    // user api url
    // private userApi_url:string='https://foodordersystem.glitch.me/api/user';
    private userApi_url:string='http://localhost:8000/api';
  
  // User related API end point
    Register(userData:any){
      // return this.http.post(`${this.userApi_url}/signup`,userData);
      return this.http.post(`${this.userApi_url}/fsubmit`,userData);
    }
    login(userData:any){
      return this.http.post(`${this.userApi_url}/login_submit`,userData);
    }
   }


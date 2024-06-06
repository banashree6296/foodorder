import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class FoodApiService {

  constructor(private http:HttpClient) { }

  // private api_url:string='https://foodordersystem.glitch.me/api';
  private api_url:string='http://localhost:8000/api';
  // all food related api end points
  // get all food items
  getAllFoods(){
    return this.http.get(`${this.api_url}/getall`);
  }
  getParticularFood(f_id:string){
    return this.http.get(`${this.api_url}/food/${f_id}`);
  }
//   6.GET all foods  with price limit :
// URL :https://foodordersystem.glitch.me/api/foods/lim1/lim2
// REQEST:GET
// PARAMS :lim1,lim2
getFoodbyLimit(lim1:any,lim2:any){
  return this.http.get(`${this.api_url}/foods/${lim1}/${lim2}`);
}
// add new food items
addNewFood(foodData:any){
  return this.http.post(`${this.api_url}/newfood`,foodData);
}
// update food Item
updateFood(_id:any,foodData:any){
  return this.http.put(`${this.api_url}/update/${_id}`,foodData);
}
// delete food item
deleteFood(_id:any){
  return this.http.delete(`${this.api_url}/delete/${_id}`);
}
}

import { AfterViewInit, Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Route, Router } from '@angular/router';
import { FOOD } from 'src/app/core/Models/food';
import { FoodApiService } from 'src/app/core/services/food/food-api.service';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit,AfterViewInit{
  foodItems:FOOD[]=[];
  myFood:FormGroup;
  foodObject:any=[];
  activeUser:any='';
  constructor(private fApiService:FoodApiService,private fBuilder:FormBuilder,private Route: Router){
    this.myFood=this.fBuilder.group({
      food_name:[''],
      food_desc:[''],
      food_price:[''],
      food_image:['']
    })
  }
  ngOnInit(): void {
    //call get all foods items
    this.getAllFood();
     // get local storage info
     this.getLocalstorageData();

  }
 getLocalstorageData(){
  this.activeUser=localStorage.getItem('activeUser');

 }
 logout(){
  alert(`${this.activeUser} You have successfully logout`);
  // user info will remove from localstorage
  localStorage.clear();

  // redirect to login
  this.Route.navigateByUrl('/login');
 }
  ngAfterViewInit(): void {
    

  }


  // set image file
  setFile(Event:any){
    let file=Event.target.files[0];
    console.log(file);
    // set file into myfood
    this.myFood.get('food_image')?.setValue(file);

  }
  // get all foods items
  getAllFood(){
    this.fApiService.getAllFoods().subscribe({
      next:((res:any)=>{
        // console.log(res);
        this.foodItems=res;
        console.log(this.foodItems);
      }),
      error:((error)=>{
        console.log(error);
      })
    })
  }
  // add new food Items
  addFood(){
    // console.log(this.myFood.value);
    let foodFormData=new FormData();
    let formData=this.myFood.value;
    // foodFormData.append('food_name',this.myFood.get('food_name')?.value);
    // foodFormData.append('food_desc',this.myFood.get('food_desc')?.value);
    // foodFormData.append('food_price',this.myFood.get('food_price')?.value);
    // foodFormData.append('food_image',this.myFood.get('food_image')?.value);
    Object.keys(formData).forEach((keys:any)=>{
      foodFormData.append(keys,formData[keys])
    });
    console.log(foodFormData);
    // add food api call
    this.fApiService.addNewFood(foodFormData).subscribe({
      next:((res:any)=>{
        console.log(res);
        alert(res.message);
        // get all food
        this.getAllFood();
        // Form reset
        this.myFood.reset();
      }),
      error:((error)=>{
        console.log(error);
      })
    });
  }
//set value myFood
  myFoodSet(f:any){
    console.log(f);
    this.foodObject=f;
    // now setting up the value into myfood form
    this.myFood.get('food_name')?.setValue(this.foodObject.food_name);
    this.myFood.get('food_desc')?.setValue(this.foodObject.food_desc);
    this.myFood.get('food_price')?.setValue(this.foodObject.food_price);
    this.myFood.get('food_image')?.setValue(this.foodObject.food_image);
    
  }
 
  // update food item
  update(){
    let foodFormData=new FormData();
    let formData=this.myFood.value;
    // let image=this.foodObject.food_image;
    // console.log(image);
    // foodFormData.append('food_name',this.myFood.get('food_name')?.value);
    // foodFormData.append('food_desc',this.myFood.get('food_desc')?.value);
    // foodFormData.append('food_price',this.myFood.get('food_price')?.value);
    // foodFormData.append('food_image',this.myFood.get('food_image')?.value);
    Object.keys(formData).forEach((keys:any)=>{
      foodFormData.append(keys,formData[keys])
    });
    // // console.log(foodFormData);
    // update api call
    this.fApiService.updateFood(this.foodObject._id,this.myFood.value).subscribe({
      
      next:((res:any)=>{
        console.log(res);
        // get call food items
        this.getAllFood();
        // form reset
        this.myFood.reset();
        alert(res.message);
      }),
      error:((error)=>{
        console.log(error);
      })
    })
  }
  // delete
  delete(_id:any){
    console.log(_id);
    var conMsg=confirm('Want to delete item?');
    console.log(conMsg);
    if(conMsg){
     // delete api 
    this.fApiService.deleteFood(_id).subscribe({
      next:((res:any)=>{
        console.log(res);
        alert(res.message);
        // get all food
        this.getAllFood();
      }),
      error:((error)=>{
        console.log(error);
      })
      
    })
    }
    
     
  
 }
}

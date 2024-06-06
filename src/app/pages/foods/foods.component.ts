import { Component, OnInit } from '@angular/core';
import { FOOD } from 'src/app/core/Models/food';

import { FoodApiService } from 'src/app/core/services/food/food-api.service';

@Component({
  selector: 'app-foods',
  templateUrl: './foods.component.html',
  styleUrls: ['./foods.component.css']
})
export class FoodsComponent implements OnInit{
  foodItems:FOOD[]=[];
  total:number=0;
  page:number=1;
  pageSize:number=3;
  lim1:number=50;
  lim2:number=100;
  validPrice: boolean=false;
  constructor(private fApiService:FoodApiService){

  }
  ngOnInit(): void {
    // get all food items
    this.getAllFood();
  }
// price change event
selectPrice(){
  if(this.lim1<this.lim2){
    console.log('Valid price range');
    // Now api call limit
    this.fApiService.getFoodbyLimit(this.lim1,this.lim2).subscribe({
      next:((res:any)=>{
        setTimeout(()=>{
          console.log(res);
        // reasign food items
        this.foodItems=res;
        },5*1000)
        
      }),
      error:((error)=>{
        console.log(error);
      })
    })
  }else{
    alert('select valid price range');
  }
}
  // get all foods items
  getAllFood(){
    this.fApiService.getAllFoods().subscribe({
      next:((res:any)=>{
        // console.log(res);
        this.foodItems=res;
        this.total=res.length;
        console.log(this.foodItems);
      }),
      error:((error)=>{
        console.log(error);
      })
    })
  }
}

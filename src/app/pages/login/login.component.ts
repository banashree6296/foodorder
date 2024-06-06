import { Component } from "@angular/core";
import { Router } from "@angular/router";
import { UserLogin, UserRegister } from "src/app/core/Models/user";
import { UserApiService } from "src/app/core/services/user/user-api.service";
//***Import Models  */

@Component({
  selector: "app-login",
  templateUrl: "./login.component.html",
  styleUrls: ["./login.component.css"],
})
export class LoginComponent {
  register: any = new UserRegister("", "", "", "");
  login: any = new UserLogin("", "");
  passValid: boolean = false;
  constructor(private uService: UserApiService, private Route: Router) {}

  /**Password Check**/
  passCheck(Event: any) {
    console.log(Event);
    let pass2 = Event.target.value;
    console.log(pass2);

    // if (this.register.pass1 == pass2) {
    //   console.log("valid");
    // } else {
    //   console.log("Invalid");
    // }

    this.passValid = this.register.pass1 == pass2 ? true : false;
    console.log(this.passValid);
  }

  /**User Register**/
  UserRegister() {
    console.log(this.register);
    this.uService.Register(this.register).subscribe({
      next: (res: any) => {
        console.log(res);
        alert(res.message);
      },
      error: (error) => {
        console.log(error);
      },
    });
  }

  /**Login User**/
  UserLogin() {
    console.log(this.login);
    this.uService.login(this.login).subscribe({
      next: (res: any) => {
        console.log(res);
        alert(res.message);

        /***User  Data Store into the Browser Loacal Storage**/
        // if(res.role=="admin"){
        //   alert("can't set user Info");
        //   this.Route.navigateByUrl("/admin");
        // }
        //   else{
        //     this.Route.navigateByUrl("/login");
        //   }


        if (res.role=="admin" ) {
          alert("hai");
          // admin path redirect
          this.Route.navigateByUrl('/admin');
          localStorage.setItem("activeUser", res.activeUser);
          // localStorage.setItem("token", res.token);
          /**Admin path redirct**/
          // this.Route.navigateByUrl("/admin");

        
        } else {
          alert("can't set user Info");
          /***User redirect into login page**/
          this.Route.navigateByUrl("/login");
        }
      },
      error: ((error:any) => {
        console.log(error);
      }),
    });
  }
}
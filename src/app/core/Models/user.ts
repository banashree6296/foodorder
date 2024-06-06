export class UserRegister{
    constructor(
        public name:string,
        public phone:string,
        public email:string,
        public pass1:string 

    ){}
}
export class UserLogin{
    constructor(
        public email:string,
        public pass1:string
    ){}
}
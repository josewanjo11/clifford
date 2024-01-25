<template>
    <h5>{{title}}</h5>
    <div class="justify-content-center">
	<div class="row">
		<div class="col-md-8">
			<div class="card mb-5">
				<div class="card-header">
					<h6 class="text-center">{{  agentMode ? 'Fill up the form to register as a travel agent' : adminMode ? 'Fill up the form to register as an admin user' : agentLogin ? 'Agent login form' : adminLogin ? 'Admin login form ' : '' }}</h6>
				</div>
				<form >
			    <div class="card-body" >
			    	<span class="text-danger" v-show="creditials">Check your creditials</span>
			    	<div v-show="agentMode">
			    		<div class="form-group">
			    			<label for="name">Name</label>
			    			<input type="text" v-model="agentData.name" class="form-control">
			    			<span class="text-danger" v-show="agentDataErrors.name">Name is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="email">Email</label>
			    			<input type="email" v-model="agentData.email" class="form-control">
			    			<span class="text-danger" v-show="agentDataErrors.email">Email is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="phone">Phone</label>
			    			<input type="number" v-model="agentData.phone" class="form-control">
			    			<span class="text-danger" v-show="agentDataErrors.phone">Phone Number is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="Password">Password</label>
			    			<input type="password" v-model="agentData.password" class="form-control">
			    			<span class="text-danger" v-show="agentDataErrors.password">Password is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="confirm_password">Confirm Password</label>
			    			<input type="password" v-model="agentData.confirm_password" class="form-control">
			    			<span class="text-danger" v-show="agentDataErrors.confirmPassword">Match your passwords</span>
			    		</div>
			    	</div>
			    	<div v-show="adminMode">
			    		<div class="form-group">
			    			<label for="name">Name</label>
			    			<input type="text" v-model="adminData.name" class="form-control">
			    			<span class="text-danger" v-show="adminDataErrors.name">Name is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="email">Email</label>
			    			<input type="email" v-model="adminData.email" class="form-control">
			    			<span class="text-danger" v-show="adminDataErrors.email">Email is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="phone">Phone</label>
			    			<input type="number" v-model="adminData.phone" class="form-control">
			    			<span class="text-danger" v-show="adminDataErrors.phone">Phone Number is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="Password">Password</label>
			    			<input type="password" v-model="adminData.password" class="form-control">
			    			<span class="text-danger" v-show="adminDataErrors.password">Password is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="confirm_password">Confirm Password</label>
			    			<input type="password" v-model="adminData.confirm_password" class="form-control">
			    			<span class="text-danger" v-show="adminDataErrors.confirmPassword">Match your passwords</span>
			    		</div>
			    	</div>
		    	<div v-show="agentLogin">
		    			<div class="form-group">
			    			<label for="email">Email</label>
			    			<input type="email" v-model="agentLoginData.email" class="form-control">
			    			<span class="text-danger" v-show="agentLoginDataErrors.email">Email is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="Password">Password</label>
			    			<input type="password" v-model="agentLoginData.password" class="form-control">
			    			<span class="text-danger" v-show="agentLoginDataErrors.password">Password is required</span>
			    		</div>
		    	</div>
		    	<div v-show="adminLogin">
		    			<div class="form-group">
			    			<label for="email">Email</label>
			    			<input type="email" v-model="adminLoginData.email" class="form-control">
			    			<span class="text-danger" v-show="adminLoginDataErrors.email">Email is required</span>
			    		</div>
			    		<div class="form-group">
			    			<label for="Password">Password</label>
			    			<input type="password" v-model="adminLoginData.password" class="form-control">
			    			<span class="text-danger" v-show="adminLoginDataErrors.password">Password is required</span>
			    		</div>
		    	</div>
			    	<div class="justify-content-center">
				    	<button type="button" class="btn btn-success float-end1 mt-3 mb-2" @click="handleClick">{{  agentMode ? 'Register' : adminMode ? 'Register' : agentLogin ? 'Login' : adminLogin ? 'Login' : '' }}</button><br>

				    	<span v-show="!adminLogin" class="text-primary cursor" @click="agentLogin=false;adminLogin=true;adminMode=false;agentMode=false;" style="cursor: pointer;">Click here to login as admin</span><br>

				    	<span v-show="!agentLogin" class="text-primary cursor" @click="agentLogin=true;adminLogin=false;adminMode=false;agentMode=false;" style="cursor: pointer;">Click here to login as agent</span><br>

				    	<span v-show="!adminMode" class="text-primary cursor" @click="agentLogin=false;adminLogin=false;adminMode=true;agentMode=false;" style="cursor: pointer;">Click here to register as admin</span><br>

				    	<span v-show="!agentMode" class="text-primary cursor" @click="agentLogin=false;adminLogin=false;adminMode=false;agentMode=true;" style="cursor: pointer;">Click here to register as agent</span>
				    </div>
			    </div>
			    
			    </form>

			</div>
		</div>
	</div>
</div>
</template>


<script>
import { ref ,inject } from 'vue';
import { provide } from 'vue';
import DashboardComponent from './DashboardComponent.vue';
export default {
	
    setup: () => ({
        title: 'Welcome To Travel Agents and Accommodation System'
        
    }),

    data() {
        return {
            user :inject('user'),
            adminMode: false,
            agentMode: false,
            agentLogin:true,
            adminLogin:false,
            creditials:false,
            agentData:{
	    		name:'',
	    		email:'',
	    		phone:'',
	    		password:'',
	    		confirm_password:'',
	    	},
	    	agentDataErrors:{
	    		name:false,
	    		email:false,
	    		phone:false,
	    		password:false,
	    		confirmPassword:false,
	    	},
	    	adminData:{
	    		name:'',
	    		email:'',
	    		phone:'',
	    		password:'',
	    		confirm_password:'',
	    	},
	    	adminDataErrors:{
	    		name:false,
	    		email:false,
	    		phone:false,
	    		password:false,
	    		confirmPassword:false,
	    	},
	    	adminLoginData:{
	    		email:'',
	    		password:''
	    	},
	    	adminLoginDataErrors:{
	    		email:false,
	    		password:false
	    	},
	    	agentLoginData:{
	    		email:'',
	    		password:''
	    	},
	    	agentLoginDataErrors:{
	    		email:false,
	    		password:false
	    	}
        }
    },
    mounted() {
        
    },
    methods: {
   		 handleClick() {
	      if (this.agentMode) {
	        this.registerAgent();
	      } else if (this.adminMode) {
	        this.registerAdmin();
	      } else if (this.agentLogin) {
	        this.loginAgent();
	      } else if (this.adminLogin) {
	        this.loginAdmin();
	      }
	    },
        registerAgent()
    	{
    		this.agentData.name == '' ? this.agentDataErrors.name = true : this.agentDataErrors.name = false
    		this.agentData.email == '' ? this.agentDataErrors.email = true : this.agentDataErrors.email = false

    		this.agentData.phone == '' ? this.agentDataErrors.phone = true : this.agentDataErrors.phone = false

    		this.agentData.password == '' ? this.agentDataErrors.password = true : this.agentDataErrors.password = false

    		this.agentData.confirm_password != this.agentData.password ? this.agentDataErrors.confirmPassword = true : this.agentDataErrors.confirmPassword = false

    		if(this.agentData.name && this.agentData.email && this.agentData.phone && this.agentData.password == this.agentData.confirm_password)
    		{
    			axios.post('api/addAgent/',this.agentData).then(response=>{
    				console.log(response.data);
    				this.adminMode= false
		            this.agentMode= false
		            this.agentLogin=true
		            this.adminLogin=false
		            this.agentData={
			    		name:'',
			    		email:'',
			    		phone:'',
			    		password:'',
			    		confirm_password:'',
			    	}
			    	this.agentDataErrors={
			    		name:false,
			    		email:false,
			    		phone:false,
			    		password:false,
			    		confirmPassword:false,
			    	}
    			}).catch(errors=>{

    			}).finally(()=>{
    			
    				
			    	
    			});
    		}

    	},
    	registerAdmin(){
    		this.adminData.name == '' ? this.adminDataErrors.name = true : this.adminDataErrors.name = false
    		this.adminData.email == '' ? this.adminDataErrors.email = true : this.adminDataErrors.email = false

    		this.adminData.phone == '' ? this.adminDataErrors.phone = true : this.adminDataErrors.phone = false

    		this.adminData.password == '' ? this.adminDataErrors.password = true : this.adminDataErrors.password = false

    		this.adminData.confirm_password != this.adminData.password ? this.adminDataErrors.confirmPassword = true : this.adminDataErrors.confirmPassword = false

    		if(this.adminData.name && this.adminData.email && this.adminData.phone && this.adminData.password == this.adminData.confirm_password)
    		{
    			axios.post('api/addAdmin/',this.adminData).then(response=>{
    				console.log(response.data);
    				this.adminMode= false
		            this.agentMode= false
		            this.agentLogin=false
		            this.adminLogin=true
		            this.adminData={
			    		name:'',
			    		email:'',
			    		phone:'',
			    		password:'',
			    		confirm_password:'',
			    	}
			    	this.adminDataErrors={
			    		name:false,
			    		email:false,
			    		phone:false,
			    		password:false,
			    		confirmPassword:false,
			    	}
    			}).catch(errors=>{

    			}).finally(()=>{
    			
    				
			    	
    			});
    		}
    	},
    	loginAgent()
    	{
    	
    		this.agentLoginData.email == '' ? this.agentLoginDataErrors.email = true : this.agentLoginDataErrors.email = false
    		this.agentLoginData.password == '' ? this.agentLoginDataErrors.password = true : this.agentLoginDataErrors.password = false
    		if(this.agentLoginData.email && this.agentLoginData.password)
    		{

    			axios.post(window.url+'api/loginAgent',this.agentLoginData).then(response=>{
    				if(response.data.message)
    				{
    					console.log(response.data.message)
    				
					this.$router.push({ 
					  name: 'dashboard', 
					  query: { agentId: response.data.agentId } 
					});

    				
    				}
    				else if(response.data.error)
    				{
    				  console.log(response.data.error)
    				  this.creditials=true
    				}
    				else
    				{
    				  console.log(response.data)
    				  this.servererror=true
    				}

    				
    			}).catch(errors=>{
    				console.log(errors)
    			}).finally(()=>{

    			})

    		}

    	},
    	loginAdmin()
    	{
    		this.adminLoginData.email == '' ? this.adminLoginDataErrors.email = true : this.adminLoginDataErrors.email = false
    		this.adminLoginData.password == '' ? this.adminLoginDataErrors.password = true : this.adminLoginDataErrors.password = false
    		if(this.adminLoginData.email && this.adminLoginData.password)
    		{
    			axios.post(window.url+'api/loginAdmin',this.adminLoginData).then(response=>{
    				if(response.data.message)
    				{
    					console.log(response.data.message)
    					
    					this.$router.push({ 
					  name: 'dashboard', 
					  query: { agentId: response.data.agentId } 
					});
    				}
    				else if(response.data.error)
    				{
    				  console.log(response.data.error)
    				  this.creditials=true
    				}
    				else
    				{
    				  console.log(response.data)
    				  this.servererror=true
    				}

    				
    			}).catch(errors=>{
    				console.log(errors)
    			}).finally(()=>{

    			})
    		}
    	}
    }
}
</script>


<template>
 <ul class="nav nav-tabs">
 <li class="nav-item">
    <a :class="`nav-link ${activetab=='accommodations' ? 'active' : ' '}`" data-toggle="tab"  @click="changeTab('accommodations')">Accommodations</a>
  </li>
  <li class="nav-item " v-show="!agentMode">
    <a :class="`nav-link ${activeTab=='contracts' ? 'active' : ''}`" data-toggle="tab" @click="changeTab('contracts')">Contracts</a>
  </li>
  
  <li class="nav-item " >
    <a :class="`nav-link ${activetab=='bookings' ? 'active' : ''}`" data-toggle="tab" @click="changeTab('bookings')">Bookings</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="row">
<div class="cool-md-8">
<div class="tab-content">
  
  <div :class="`tab-pane container  ${activeTab=='accommodations' ? 'active' : 'fade'}`" >
    <div class="card mt-3">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-light float-start">Available Accommodations</h5>
                        </div>
                        <div class="col-md-6" v-show="!agentMode">
                            <button @click="createAccommodation" class="btn btn-success btn-sm float-end">New Accommodation</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Standard rack rates</th>
                                    <th>Description</th>
                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(accommodation, index) in accommodations" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{accommodation.name}}</td>
                                    <td>{{accommodation.standard_rack_rate }} </td>
                                    <td>
                                        {{accommodation.description.length <= 50 ? accommodation.description : accommodation.description.substr(0, 10) + '...'}}
                                    </td>
                                    <td v-show="!agentMode">
                                        <button @click="editAccommodation(accommodation)" class="btn btn-primary btn-sm mx-1">Edit</button>
                                        <button @click="removeAccommodation(accommodation)" class="btn btn-danger btn-sm mx-1">Delete</button>
                                        <button @click="viewContracts(accommodation)" class="btn btn-success btn-sm mx-1">Contracts</button>
                                    </td>
                                    <td v-show="agentMode">
                                        <button @click="createBooking(accommodation)" class="btn btn-success btn-sm mx-1">Book</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
  </div>
  <div :class="`tab-pane container  ${activeTab=='contracts' ? 'active' : 'fade'}`" >
     
    <div class="card mt-3">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-light float-start">Available Contracts</h5>
                        </div>
                        <div class="col-md-6">
                            <button @click="createContract" class="btn btn-success btn-sm float-end">New Contract</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Contract Rates</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>accommodation</th>
                                    <th>Agent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(contract, index) in contracts" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{contract.contract_rate}}</td>
                                    <td>{{contract.start_date    }} </td>
                                    <td>{{contract.end_date    }} </td>
                                    <td>{{contract.accommodation.name }} </td>
                                    <td>{{contract.travel_agent.name }} </td>
                                    <td>
                                        <button @click="editContract(contract)" class="btn btn-primary btn-sm mx-1">Edit</button>
                                        <button @click="removeContract(contract)" class="btn btn-danger btn-sm mx-1">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
  </div>
  <div :class="`tab-pane container  ${activeTab=='bookings' ? 'active' : 'fade'}`" >
    <div class="card mt-3">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-light float-start">Bookings</h5>
                        </div>
                       
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Details</th>
                                    <th>Accommodation</th>
                                    <th>Agent</th>
                                    <th>Check In Date</th>
                                    <th>Check Out Date</th>
                                    <th>Rates</th>
                                    <th>Rooms</th>
                                    <th>Totals</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(booking, index) in bookings" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{booking.clientName}}<br>{{ booking.clientEmail }}<br>{{ booking.clientPhone }}<br>{{ booking.clientAddress }}</td>
                                    <td>{{booking.accommodation.name    }} </td>
                                    <td>{{booking.travel_agent.name   }} </td>
                                    <td>{{booking.checkInDate }} </td>
                                    <td>{{booking.checkOutDate }} </td>
                                    <td>{{booking.rates }} </td>
                                    <td>{{booking.rooms }} </td>
                                    <td>{{booking.totals }} </td>
                                    <td>
                                        <button @click="editBooking(booking)" class="btn btn-primary mt-1 btn-sm mx-1">Edit</button>
                                        <button @click="cancelBooking(booking)" class="btn btn-danger mt-1 btn-sm mx-1">Cancel</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
  </div>
</div>
</div>
</div>

<!--  Modal for adding,updating and deleting accommodations  -->
    <div class="modal fade" id="accommodationModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div :class="`modal-dialog modal-dialog-centered ${!accommodationDeleteMode ? 'modal-lg' : 'modal-sm'}`">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="accommodationModalLabel" v-show="!accommodationDeleteMode">{{!accommodationEditMode ? 'Create New Accommodation' : 'Update Accommodation'}}</h5>
            <h5 class="modal-title" id="taskModalLabel" v-show="accommodationDeleteMode">Delete Accommodation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row" v-show="!accommodationDeleteMode">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control" v-model="accommodationData.name">
                        <span class="text-danger" v-show="accommodationDataErrors.name">Name is required</span>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="time">Standard Rack Rates</label>
                        <input type="number" class="form-control" v-model="accommodationData.rates">
                        <span class="text-danger" v-show="accommodationDataErrors.rates">Rates are required</span>
                    </div>
                </div>
            </div>
            <div class="row" v-show="!accommodationDeleteMode">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3" v-model="accommodationData.description"></textarea>
                    </div>
                </div>
            </div>

            <h5 class="text-center" v-show="accommodationDeleteMode">Are you sure you want to delete this accommodation?</h5>
        </div>
        <div class="modal-footer" v-show="!accommodationDeleteMode">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" @click="!accommodationEditMode ? storeAccommodation() : updateAccommodation()" class="btn btn-primary">{{!accommodationEditMode ? 'Create Accommodation' : 'Save Changes'}}</button>
        </div>
        <div class="modal-footer" v-show="accommodationDeleteMode">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" @click="deleteAccommodation" class="btn btn-primary">Delete Accommodation</button>
        </div>
        </div>
    </div>
    </div>



<!--  Modal for adding,updating and deleting bookings  -->
<div class="modal fade" tabindex="-1" role="dialog" id="bookingModal">
  <div :class="`modal-dialog modal-dialog-centered ${!bookingCancelMode ? 'modal-lg' : 'modal-sm'}`" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel" v-show="!bookingCancelMode">{{!bookingEditMode ? 'Accomodation Booking Form' : 'Update booking details'}}</h5>
            <h5 class="modal-title" id="bookingModalLabel" v-show="bookingCancelMode">Cancel booking</h5>
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form @submit.prevent="storeBooking" v-show="!bookingCancelMode">
      <!-- Client Information -->
      <div class="form-section">
        <div class="section-header"><b>Client Information</b></div>
        <div class="form-group">
          <label for="clientName">Client Name:</label>
          <input type="text" id="clientName" v-model="bookingData.clientName" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="clientEmail">Client Email:</label>
          <input type="email" id="clientEmail" v-model="bookingData.clientEmail" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="clientPhone">Client Phone:</label>
          <input type="tel" id="clientPhone" v-model="bookingData.clientPhone" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="clientAddress">Client Address:</label>
          <textarea id="clientAddress" v-model="bookingData.clientAddress" class="form-control" required></textarea>
        </div>
      </div>

      <!-- Booking Details -->
      <div class="form-section">
        <div class="section-header"><b>Booking Details</b></div>
        <div class="form-group" >
          <div v-if="contractRates && Object.keys(contractRates).length > 0">
              <label for="contractRates">Contract Rates:</label>
              <select v-model="bookingData.rates" class="form-control">
                <option v-for="(contract,index) in contractRates" :key="index" :value="contract.contract_rate">{{ contract.contract_rate }}</option>
              </select>
          </div>
          <div v-else="">
            <h4 class="text-success" >Standard Rack Rates {{ standardRackRates }}</h4>
          </div>
        </div>
        
        <div class="form-group">
          <label for="checkInDate">Check-In Date:</label>
          <input type="date" class="form-control" v-model="bookingData.checkInDate" required />
        </div>
        <div class="form-group">
          <label for="checkOutDate">Check-Out Date:</label>
          <input type="date" class="form-control" v-model="bookingData.checkOutDate" required />
        </div>
        <div class="form-group">
          <label for="numRooms">Number of Rooms:</label>
          <input type="number" id="numRooms" v-model="bookingData.rooms" class="form-control" required />
        </div>
        <h4 class="text-success mt-2" v-if="totalAmount">Total Amount {{ totalAmount }}</h4>
      </div>
      
      <button type="submit" class="btn btn-primary mt-3">{{!bookingEditMode ? 'Submit' : 'Save Changes'}}</button>
    </form>
    <h6 v-show="bookingCancelMode">Are you sure you want to cancel?</h6>
      </div>
      <div class="modal-footer" v-show="bookingCancelMode">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" @click="removeBooking(bookingData.id)" class="btn btn-primary">Cancel Booking</button>
        </div>
      
    </div>
  </div>
</div>
    

<!--  Modal for adding,updating and deleting contracts  -->
<div class="modal fade" id="contractModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div :class="`modal-dialog modal-dialog-centered ${!contractDeleteMode ? 'modal-lg' : 'modal-sm'}`">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="contractModalLabel" v-show="!contractDeleteMode">{{!contractEditMode ? 'Create New contract' : 'Update contract'}}</h5>
            <h5 class="modal-title" id="taskModalLabel" v-show="contractDeleteMode">Delete contract</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row" v-show="!contractDeleteMode">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="agent">Agent</label>
                        <select class="form-control" v-model="contractData.agent">
                            <option v-for="(agent,index) in agents" :key="index" :value="agent.id">{{ agent.name }}</option>
                        </select>
                        <span class="text-danger" v-show="contractDataErrors.agent">Agent is required</span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="accommodation">Accommodation</label>
                        <select class="form-control" v-model="contractData.accommodation">
                            <option v-for="(accommodation,index) in accommodations" :key="index" :value="accommodation.id">{{ accommodation.name }}</option>
                        </select>
                        <span class="text-danger" v-show="contractDataErrors.accommodation">Accommodation is required</span>
                    </div>
                </div>
            </div>
            <div class="row" v-show="!contractDeleteMode">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start date">Start Date</label>
                        <input type="date" class="form-control" v-model="contractData.start_date">
                        <span class="text-danger" v-show="contractDataErrors.start_date">Start Date is required</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end date">End Date</label>
                        <input type="date" class="form-control" v-model="contractData.end_date">
                        <span class="text-danger" v-show="contractDataErrors.end_date">End Date is required</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="contract rates">Contract Rates</label>
                        <input type="number" class="form-control" v-model="contractData.contract_rates">
                        <span class="text-danger" v-show="contractDataErrors.contract_rates">Contract Rates is required</span>
                    </div>
                </div>
            </div>

            <h5 class="text-center" v-show="contractDeleteMode">Are you sure you want to delete this contract?</h5>
        </div>
        <div class="modal-footer" v-show="!contractDeleteMode">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" @click="!contractEditMode ? storeContract() : updateContract()" class="btn btn-primary">{{!contractEditMode ? 'Create Contract' : 'Save Changes'}}</button>
        </div>
        <div class="modal-footer" v-show="contractDeleteMode">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" @click="deleteContract" class="btn btn-primary">Delete Contract</button>
        </div>
        </div>
    </div>
    </div>

<!--  Modal for viewing contracts  -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewContractsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ viewContractModalTitle }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="agent">Select Agent</label>
        <select class="form-control" v-model="agentId" @change="filterContracts">
            <option v-for="(agent,index) in agents" :key="index" :value="agent.id">{{ agent.name }}</option>
        </select>
        <h6 class="text-success mb-4 mt-2" v-if="contractRates">Available Contract Rates : <br>
            <ul>
                <li v-for="(contract, index) in contractRates" :key="index">{{ contract.contract_rate }} ends on {{ contract.end_date }}</li>
            </ul>
        </h6>
      </div>
      
    </div>
  </div>
</div>


</template>

<script>
import { ref ,inject,computed } from 'vue';
export default {
    setup: () => ({
        title: 'Welcome To Travel Agents and Accommodation System'
    }),
    data() {
        return {

            accommodationEditMode: false,
            accommodationDeleteMode: false,
            agentId:this.$route.query.agentId,
            agentMode:false,
            contractRates:null,
            standardRackRates:null,
            viewContractModalTitle:null,
            totalAmount:null,
            bookingEditMode: false,
            bookingCancelMode: false,
            accommodationData: {
                id: '',
                name: '',
                description: '',
                rates: '',
                
            },
            accommodationDataErrors: {
                name: false,
                description: false,
                rates: false,
            },
            contractEditMode: false,
            contractDeleteMode: false,
            contractData: {
                id: '',
                contract_rates: '',
                accommodation: '',
                agent: '',
                start_date:'',
                end_date:'',
                
            },
            contractDataErrors: {
                contract_rates: false,
                accommodation: false,
                agent: false,
                start_date:false,
                end_date:false,
            },
            
            bookingData: {
                id: '',
                clientName: '',
                clientEmail: '',
                clientPhone: '',
                checkInDate:'',
                checkOutDate:'',
                rooms:1,
                clientAddress:'',
                room_id:'',
                agent:this.agentId,
                rates:'', 
                totals:'',   
            },
            bookingDataErrors: {
                id: false,
                clientName: false,
                clientEmail: false,
                clientPhone: false,
                checkInDate:false,
                checkOutDate:false,
                rooms:false,
                clientAddress:false,
            },
            activeTab:'accommodations',
            accommodations:{},
            contracts:{},
            bookings:{},
            agents:{},
           
        }
    },
   computed: {
   //calculating total amount for booking
    totalAmount() {
      if (this.bookingData.checkInDate && this.bookingData.checkOutDate) {
        const startDate = new Date(this.bookingData.checkInDate);
        const endDate = new Date(this.bookingData.checkOutDate);
        const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
        const numberOfNights = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Calculate number of nights
        if(this.bookingData.rates)
        {
           
            this.bookingData.totals=numberOfNights * this.bookingData.rates * this.bookingData.rooms
            return numberOfNights * this.bookingData.rates * this.bookingData.rooms;
            
        }
        else
        {
             this.bookingData.rates=this.standardRackRates
             this.bookingData.totals=numberOfNights * this.standardRackRates * this.bookingData.rooms
            return numberOfNights * this.standardRackRates * this.bookingData.rooms;
           
        }
        
      } else {
        return 0; // Handle the case when dates are not selected
      }
    },
  },
    mounted() {
        this.getAccommodations()
        this.getContracts()
        this.getBookings()
        this.getAgents()
        this.getLoginSession()
        if(this.$route.query.agentId!='null')
        {
          this.agentMode=true
        }
        else
        {
            this.agentMode=false
        }
    },
    methods: {
        changeTab(tab) {
          this.activeTab = tab;
        },

        getLoginSession()
        {
           axios.post(window.url+'api/getLoginSession').then(response=>{
            console.log(response.data)
           }).catch(errors=>{
            console.log(errors)
           });
             
        },


        getContracts() {
            axios.get(window.url + 'api/getContracts').then(response => {
                this.contracts = response.data
                console.log(response.data)
            }).catch(errors => {
                console.log(errors)
            });
        },


        getAccommodations() {
            axios.get(window.url + 'api/getAccommodations').then(response => {
                this.accommodations = response.data
                console.log(this.accommodations)
            }).catch(errors => {
                console.log(errors)
            });
        },


        getBookings() {
            axios.get(window.url + 'api/getBookings/'+this.agentId).then(response => {
                this.bookings = response.data
                console.log(response.data)
            }).catch(errors => {
                console.log(errors)
            });
        },


        getAgents() {
            axios.get(window.url + 'api/getAgents').then(response => {
                this.agents = response.data

            }).catch(errors => {
                console.log(errors)
            });
        },


        deleteAccommodation() {
            axios.post(window.url + 'api/deleteAccommodation/' + this.accommodationData.id).then(response => {
                this.getAccommodations()
                this.getContracts()
            }).catch(errors => {
                console.log(errors)
            }).finally(() => {
                $('#accommodationModal').modal('hide')
            });
        },


        removeAccommodation(accommodation) {
            this.accommodationDeleteMode = true
            this.accommodationData.id = accommodation.id
            $('#accommodationModal').modal('show')
        },


        viewContracts(accommodation) {
            this.accommodationData.id = accommodation.id
            this.viewContractModalTitle='Contract Rates For '+ accommodation.name
            $('#viewContractsModal').modal('show')
        },


       async filterContracts()
        {
        
         const response=await axios.get('api/getContractRates/'+this.accommodationData.id +'/'+this.agentId)
         this.contractRates=response.data
         console.log(response.data)
        },


        updateAccommodation() {
            this.accommodationData.name == '' ? this.accommodationDataErrors.name = true : this.accommodationDataErrors.name = false
            this.accommodationData.description == '' ? this.accommodationDataErrors.description = true : this.accommodationDataErrors.description = false
            this.accommodationData.rates == '' ? this.accommodationDataErrors.rates = true : this.accommodationDataErrors.rates = false

            if(this.accommodationData.id && this.accommodationData.name && this.accommodationData.description && this.accommodationData.rates) {
                axios.post(window.url + 'api/updateAccommodation/'+this.accommodationData.id, this.accommodationData).then(response => {
                    this.getAccommodations()
                    this.getContracts()
                }).catch(errors => {
                    console.log(errors)
                }).finally(() => {
                    $('#accommodationModal').modal('hide')
                });
            }
        },
        editAccommodation(accommodation) {

            this.accommodationDeleteMode = false
            this.accommodationEditMode = true
            this.accommodationData = {
                id: accommodation.id,
                name: accommodation.name,
                rates: accommodation.standard_rack_rate,
                description: accommodation.description,
            }
            this.accommodationDataErrors = {
                name: false,
                rates: false,
                description: false,
            }
            $('#accommodationModal').modal('show')
        },
        createAccommodation() {
            this.accommodationDeleteMode = false
            this.accommodationEditMode = false
            this.accommodationData = {
                id: '',
                name: '',
                description: '',
                rates: '',
                
            }
            this.accommodationDataErrors = {
                name: false,
                description: false,
                rates: false,
            }
            $('#accommodationModal').modal('show')
        },
        storeAccommodation() {

            this.accommodationData.name == '' ? this.accommodationDataErrors.name = true : this.accommodationDataErrors.name = false
            this.accommodationData.description == '' ? this.accommodationDataErrors.description = true : this.accommodationDataErrors.description = false
            this.accommodationData.rates == '' ? this.accommodationDataErrors.rates = true : this.accommodationDataErrors.rates = false

            if(this.accommodationData.name && this.accommodationData.description && this.accommodationData.rates) {
                axios.post(window.url + 'api/storeAccommodation', this.accommodationData).then(response => {
                    this.getAccommodations()
                }).catch(errors => {
                    console.log(errors)
                }).finally(() => {
                    $('#accommodationModal').modal('hide')
                });
            }
        },


        //methods for contracts

        
         deleteContract() {
            axios.post(window.url + 'api/deleteContract/' + this.contractData.id).then(response => {
                this.getContracts()
            }).catch(errors => {
                console.log(errors)
            }).finally(() => {
                $('#contractModal').modal('hide')
            });
        },
        removeContract(contract) {
            this.contractDeleteMode = true
            this.contractData.id = contract.id
            $('#contractModal').modal('show')
        },
        updateContract() {
            this.contractData.contract_rates == '' ? this.contractDataErrors.contract_rates = true : this.contractDataErrors.contract_rates = false
            this.contractData.start_date == '' ? this.contractDataErrors.start_date = true : this.contractDataErrors.start_date = false
            this.contractData.end_date == '' ? this.contractDataErrors.end_date = true : this.contractDataErrors.end_date = false
            this.contractData.accommodation == '' ? this.contractDataErrors.accommodation = true : this.contractDataErrors.accommodation = false
            this.contractData.agent == '' ? this.contractDataErrors.agent = true : this.contractDataErrors.agent = false
           
            if(this.contractData.id && this.contractData.contract_rates && this.contractData.start_date && this.contractData.end_date && this.contractData.accommodation && this.contractData.agent) {
                axios.post(window.url + 'api/updateContract/'+this.contractData.id, this.contractData).then(response => {
                    this.getContracts()
                    this.filterContracts()
                }).catch(errors => {
                    console.log(errors)
                }).finally(() => {
                    $('#contractModal').modal('hide')
                });
            }
        },
        editContract(contract) {
            this.contractDeleteMode = false
            this.contractEditMode = true
            this.contractData = {
                id: contract.id,
                contract_rates: contract.contract_rate,
                start_date: contract.start_date,
                end_date: contract.end_date,
                accommodation: contract.accommodation_id,
                agent: contract.travel_agent_id,
            }
            this.contractDataErrors = {
                contract_rates: false,
                end_date: false,
                start_date: false,
                accommodation: false,
                agent: false,
            }
            $('#contractModal').modal('show')
        },
        createContract() {
            this.contractDeleteMode = false
            this.contractEditMode = false
            this.contractData= {
                id: '',
                contract_rates: '',
                accommodation: '',
                agent: '',
                start_date:'',
                end_date:'',
                
            }
            this.contractDataErrors= {
                contract_rates: false,
                accommodation: false,
                agent: false,
                start_date:false,
                end_date:false,
            }
            $('#contractModal').modal('show')
        },
        storeContract() {
           
            this.contractData.contract_rates == '' ? this.contractDataErrors.contract_rates = true : this.contractDataErrors.contract_rates = false
            this.contractData.start_date == '' ? this.contractDataErrors.start_date = true : this.contractDataErrors.start_date = false
            this.contractData.end_date == '' ? this.contractDataErrors.end_date = true : this.contractDataErrors.end_date = false
            this.contractData.accommodation == '' ? this.contractDataErrors.accommodation = true : this.contractDataErrors.accommodation = false
            this.contractData.agent == '' ? this.contractDataErrors.agent = true : this.contractDataErrors.agent = false

            if(this.contractData.contract_rates && this.contractData.start_date && this.contractData.end_date && this.contractData.accommodation && this.contractData.agent) {
                axios.post(window.url + 'api/storeContract', this.contractData).then(response => {
                    this.getContracts()
                    this.filterContracts()
                }).catch(errors => {
                    console.log(errors)
                }).finally(() => {
                    $('#contractModal').modal('hide')
                });
            }
        },


        //methods for bookings


         createBooking(accommodation) {
            this.bookingCancelMode = false
            this.bookingEditMode = false
            this.standardRackRates=accommodation.standard_rack_rate
            this.bookingData={
                id: '',
                clientName: '',
                clientEmail: '',
                clientPhone: '',
                checkInDate:'',
                checkOutDate:'',
                rooms:1,
                clientAddress:'',
                room_id:accommodation.id,
                agent:this.agentId,
                rates:'',
                totals:'',
                
            }
            this.bookingDataErrors= {
                id: false,
                clientName: false,
                clientEmail: false,
                clientPhone: false,
                checkInDate:false,
                checkOutDate:false,
                rooms:false,
                clientAddress:false,
            }
            this.accommodationData.id=accommodation.id
            this.filterContracts()
            $('#bookingModal').modal('show')
        },
        storeBooking(){
            if(this.bookingEditMode)
            {
                axios.post(window.url+'api/updateBooking/'+this.bookingData.id,this.bookingData).then(response=>{
                 this.getBookings()
                 this.changeTab('bookings')
                }).catch(errors=>{
                 console.log(errors)
                }).finally(()=>{
                 $('#bookingModal').modal('hide')
                })
            }
            else
            {
                axios.post(window.url+'api/storeBookings',this.bookingData).then(response=>{
                 this.getBookings()
                 this.changeTab('bookings')
                }).catch(errors=>{
                 console.log(errors)
                }).finally(()=>{
                 $('#bookingModal').modal('hide')
                })
            }
            
        },
        cancelBooking(booking) {
            this.bookingCancelMode = true
            this.bookingData.id = booking.id
            $('#bookingModal').modal('show')
        },
         editBooking(booking) {
            this.bookingCancelMode = false
            this.bookingEditMode = true
            this.agentId=booking.travel_agent_id
            this.totalAmount=booking.totals
            this.accommodationData.id=booking.accommodation_id
           this.bookingData={
                id: booking.id,
                clientName: booking.clientName,
                clientEmail: booking.clientEmail,
                clientPhone: booking.clientPhone,
                checkInDate:booking.checkInDate,
                checkOutDate:booking.checkOutDate,
                rooms:booking.rooms,
                clientAddress:booking.clientAddress,
                room_id:booking.accommodation_id,
                agent:this.agentId,
                rates:booking.rates,
                totals:booking.totals,
                
            }
            this.bookingDataErrors = {
                id: false,
                clientName: false,
                clientEmail: false,
                clientPhone: false,
                checkInDate:false,
                checkOutDate:false,
                rooms:false,
                clientAddress:false,
            }
            this.filterContracts()
            $('#bookingModal').modal('show')
        },
        removeBooking(id) {
            
            axios.post(window.url + 'api/cancelBooking/' + id).then(response => {
                this.getBookings()
            }).catch(errors => {
                console.log(errors)
            }).finally(() => {
                $('#bookingModal').modal('hide')
            });
        },
       


}
        
}
</script>


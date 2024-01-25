<template>
 <ul class="nav nav-tabs">
 <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#accommodations">Accommodations</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " data-toggle="tab" href="#contracts">Contracts</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#bookings">Bookings</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="row">
<div class="cool-md-8">
<div class="tab-content">
  
  <div class="tab-pane container active" id="accommodations">
    <div class="card mt-3">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-light float-start">Available Accommodations</h5>
                        </div>
                        <div class="col-md-6">
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
                                    <th>Description</th>
                                    <th>Standard rack rates</th>
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
                                    <td>
                                        <button @click="editAccommodation(accommodation)" class="btn btn-primary btn-sm mx-1">Edit</button>
                                        <button @click="removeAccommodation(accommodation)" class="btn btn-danger btn-sm mx-1">Delete</button>
                                        <button @click="viewContracts(accommodation)" class="btn btn-danger btn-sm mx-1">Contracts</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
  </div>
  <div class="tab-pane container fade " id="contracts">
     
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
  <div class="tab-pane container fade" id="bookings">
    <h1>Bookings</h1>
  </div>
</div>
</div>
</div>

<!-- Modal -->
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
        <h6 class="text-success mb-4 mt-2" v-if="contractRates">Contract Rates : {{ contractRates }}</h6>
      </div>
      
    </div>
  </div>
</div>
</template>

<script>
import { ref ,inject,computed } from 'vue';
export default {
    setup: () => ({
        title: 'All Tasks'
    }),
    data() {
        return {

            accommodationEditMode: false,
            accommodationDeleteMode: false,
            agentId:{},
            contractRates:null,
            viewContractModalTitle:null,
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
            accommodations:{},
            contracts:{},
            bookings:{},
            agents:{},
           
        }
    },
    computed: {
    user() {
      return this.$store.state.user;
      console.log(this.$store.state.user)
    },
  },
 

    mounted() {
        this.getAccommodations()
        this.getContracts()
        this.getBookings()
        this.getAgents()
    },
    methods: {
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
            axios.get(window.url + 'api/getBookings').then(response => {
                this.bookings = response.data
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
            alert('qwwe')
            if(this.contractData.id && this.contractData.contract_rates && this.contractData.start_date && this.contractData.end_date && this.contractData.accommodation && this.contractData.agent) {
                axios.post(window.url + 'api/updateContract/'+this.contractData.id, this.contractData).then(response => {
                    this.getContracts()
                }).catch(errors => {
                    console.log(errors)
                }).finally(() => {
                    $('#contractModal').modal('hide')
                });
            }
        },
        editContract(contract) {
            this.deleteContractMode = false
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
            alert(this.contractData.agent)
            this.contractData.contract_rates == '' ? this.contractDataErrors.contract_rates = true : this.contractDataErrors.contract_rates = false
            this.contractData.start_date == '' ? this.contractDataErrors.start_date = true : this.contractDataErrors.start_date = false
            this.contractData.end_date == '' ? this.contractDataErrors.end_date = true : this.contractDataErrors.end_date = false
            this.contractData.accommodation == '' ? this.contractDataErrors.accommodation = true : this.contractDataErrors.accommodation = false
            this.contractData.agent == '' ? this.contractDataErrors.agent = true : this.contractDataErrors.agent = false

            if(this.contractData.contract_rates && this.contractData.start_date && this.contractData.end_date && this.contractData.accommodation && this.contractData.agent) {
                axios.post(window.url + 'api/storeContract', this.contractData).then(response => {
                    this.getContracts()
                }).catch(errors => {
                    console.log(errors)
                }).finally(() => {
                    $('#contractModal').modal('hide')
                });
            }
        }



}
        
}
</script>
<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        Client Users
                    </span>

                    <a class="action-link" tabindex="-1" @click="showCreateClientForm">
                        Create New Client User
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="clients.length === 0">
                    You have not created any client users.
                </p>

                <table class="table table-borderless mb-0" v-if="clients.length > 0">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Label</th>
                            <th>Created @</th>
                            <th>Updated @</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="client in clients">
                            <!-- ID -->
                            <td style="vertical-align: middle;">
                                {{ client.id }}
                            </td>

                            <!-- Name -->
                            <td style="vertical-align: middle;">
                                {{ client.first_name }}
                            </td>

                             <!-- Name -->
                            <td style="vertical-align: middle;">
                                {{ client.last_name }}
                            </td>

                             <!-- Name -->
                            <td style="vertical-align: middle;">
                                {{ client.phone }}
                            </td>

                            <!-- Secret -->
                            <td style="vertical-align: middle;">
                                {{ client.label }}
                            </td>

                            <!-- Secret -->
                            <td style="vertical-align: middle;">
                                {{ client.created_at }}
                            </td>
                            <!-- Secret -->
                            <td style="vertical-align: middle;">
                                {{ client.updated_at }}
                            </td>

                            <!-- Edit Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link" tabindex="-1" @click="edit(client)">
                                    Edit
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(client)">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Client Modal -->
        <div class="modal fade" id="modal-create-client" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Create Client User
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in createForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Client Form -->
                        <form role="form">
                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">First Name</label>

                                <div class="col-md-9">
                                    <input id="create-client-firstname" type="text" class="form-control"
                                                                @keyup.enter="store" v-model="createForm.first_name">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Last Name</label>

                                <div class="col-md-9">
                                    <input id="create-client-lastname" type="text" class="form-control"
                                                                @keyup.enter="store" v-model="createForm.last_name">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone</label>

                                <div class="col-md-9">
                                    <input id="create-client-phone" type="text" class="form-control"
                                                                @keyup.enter="store" v-model="createForm.phone">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Label</label>

                                <div class="col-md-9">
                                    <input id="create-client-label" type="text" class="form-control"
                                                                @keyup.enter="store" v-model="createForm.label">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="store">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Client Modal -->
        <div class="modal fade" id="modal-edit-client" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Client
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Client Form -->
                        <form role="form">
                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">First Name</label>

                                <div class="col-md-9">
                                    <input id="edit-client-firstname" type="text" class="form-control"
                                                                @keyup.enter="update" v-model="editForm.first_name">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Last Name</label>

                                <div class="col-md-9">
                                    <input id="edit-client-lastname" type="text" class="form-control"
                                                                @keyup.enter="update" v-model="editForm.last_name">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone</label>

                                <div class="col-md-9">
                                    <input id="edit-client-phone" type="text" class="form-control"
                                                                @keyup.enter="update" v-model="editForm.phone">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Label</label>

                                <div class="col-md-9">
                                    <input id="edit-client-label" type="text" class="form-control"
                                                                @keyup.enter="update" v-model="editForm.label">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

const getBaseUrl = () => {
    if(__base_url != undefined)
        return __base_url;
    else
        return "http://127.0.0.1:8000";
}

const axiosInstance = axios.create({
  baseURL: getBaseUrl(),
  timeout: 5000,
  headers: {
    'Authorization': 'Bearer ' + __bearer_token,
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                clients: [],

                createForm: {
                    errors: [],
                    first_name: '',
                    last_name: '',
                    phone: '',
                    label: ''
                },

                editForm: {
                    errors: [],
                    first_name: '',
                    lastname: '',
                    phone: '',
                    label: ''
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getClients();

                $('#modal-create-client').on('shown.bs.modal', () => {
                    $('#create-client-firstname').focus();
                });

                $('#modal-edit-client').on('shown.bs.modal', () => {
                    $('#edit-client-firstname').focus();
                });
            },

            /**
             * Get all of the OAuth clients for the user.
             */
            getClients() {
                axiosInstance.get('/api/user')
                        .then(response => {

                            //console.log(response);
                            //console.log(response.data);
                            //console.log(response.data.data);

                            this.clients = response.data.data;
                        });
            },

            /**
             * Show the form for creating new clients.
             */
            showCreateClientForm() {
                $('#modal-create-client').modal('show');
            },

            /**
             * Create a new OAuth client for the user.
             */
            store() {
                this.persistClient(
                    'post', '/api/user',
                    this.createForm, '#modal-create-client'
                );
            },

            /**
             * Edit the given client.
             */
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.first_name = client.first_name;
                this.editForm.last_name = client.last_name;
                this.editForm.phone = client.phone;
                this.editForm.label = client.label;

                $('#modal-edit-client').modal('show');
            },

            /**
             * Update the client being edited.
             */
            update() {
                this.persistClient(
                    'put', '/api/user/' + this.editForm.id,
                    this.editForm, '#modal-edit-client'
                );
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                axiosInstance[method](uri, form)
                    .then(response => {
                        this.getClients();

                        form.first_name = '';
                        form.last_name = '';
                        form.phone = '';
                        form.label = '';
                        form.errors = [];

                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Destroy the given client.
             */
            destroy(client) {
                axiosInstance.delete('/api/user/' + client.id)
                        .then(response => {
                            this.getClients();
                        });
            }
        }
    }

// Actions Handled By Resource Controller

    /*
        Actions Handled By Resource Controller

        Verb	    URI	                    Action	Route Name

        GET	        /photos	                index	photos.index
        GET	        /photos/create	        create	photos.create
        POST	    /photos	                store	photos.store
        GET	        /photos/{photo}	        show	photos.show
        GET	        /photos/{photo}/edit	edit	photos.edit
        PUT/PATCH	/photos/{photo}	        update	photos.update
        DELETE	    /photos/{photo}	        destroy	photos.destroy

    */    
</script>

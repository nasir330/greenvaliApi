<template>
    <Head title="Venture Plot Edit" />

    <AuthenticatedLayout>
        <section class="content-header">
            <h1>
                Venture Plot <small> Edit Venture</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <Link :href="route('dashboard')"><i class="fa fa-dashboard"></i> Dashboard</Link>
                </li>
                <li>
                    <Link :href="route('venture-plots.index')">Venture Plots</Link>
                </li>
                <li class="active">Venture Plot Edit</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-dismissible" v-if="$page.props.flash.status == 'error'">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        {{ $page.props.flash.message }}
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Venture Plot Edit Form</h3>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="plotName" class="control-label">Plot Name </label>
                                            <input 
                                                type="text" 
                                                v-model="form.plot_name" 
                                                class="form-control" 
                                                id="plotName"
                                                placeholder="Enter Plot Name"
                                                required
                                            >
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.plot_name }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numberOfSquareFeet" class="control-label">Number of Square Feet</label>
                                            <input 
                                                type="number" 
                                                v-model="form.number_of_square_feet" 
                                                class="form-control"
                                                id="numberOfSquareFeet" 
                                                placeholder="Enter Number of Square Feet"
                                                required
                                            >
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.number_of_square_feet }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="totalPrice" class="control-label">Total Price </label>
                                            <input 
                                                type="number" 
                                                v-model="form.total_price" 
                                                class="form-control"
                                                id="totalPrice" 
                                                placeholder="Enter Total Price"
                                                required
                                            >
                                            <span class="help-block" style="color: red;">{{ errors.total_price }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="selectCustomer" class="control-label">Select Customer <span class="text-danger">*</span></label>
                                            <VueNextSelect 
                                                id="selectCustomer" 
                                                v-model="form.customer_id" 
                                                searchable
                                                :options="$page.props.all_customers" 
                                                label-by="name"
                                                class="vue-next-select" 
                                                required
                                            />
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.customer_id }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="selectStaff" class="control-label">Select Staff <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" v-model="form.staff_id" id="selectStaff" required>
                                                <option value="">Select Staff</option>
                                                <option :value="staff.id" v-for="staff in  $page.props.all_staffs">{{staff.first_name }} {{ staff.last_name }}</option>
                                            </select>
                                            <span class="help-block" style="color: red;">{{ errors.staff_id }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="handOverDate" class="control-label">Sale Date </label>
                                            <VueDatePicker 
                                                v-model="form.sale_date"
                                                placeholder="Enter Handover Date"
                                                class=""
                                                :enable-time-picker="false" 
                                                required
                                            />
                                            <span class="help-block" style="color: red;">{{ errors.sale_date }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="handOverDate" class="control-label">Handover Date </label>
                                            <VueDatePicker 
                                                v-model="form.handover_date"
                                                placeholder="Enter Handover Date"
                                                class=""
                                                :enable-time-picker="false" 
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <Link :href="route('venture-plots.index')" class="btn btn-default">Cancel</Link>
                                <button type="submit" class="btn btn-info pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissible" v-if="$page.props.flash.status == 'success'">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success</h4>
                        {{ $page.props.flash.message }}
                    </div>
                    <div class="box">
                        <div class="timeline-body text-center">
                            <span style="position: relative;" v-for="(venture_plot_image, index ) in $page.props.venture_plot.venture_plot_images">
                                <img :src="venture_plot_image.plot_image" alt="" class="margin" style="width: 150px; height: 100px">
                                <button class="btn btn-danger" style="position: absolute; left: 0;">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Venture Plot Image Upload</h3>
                        </div>
                        <form @submit.prevent="ventureImageUpload" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="plotImage" class="control-label">Upload Image</label>
                                            <input 
                                                type="file" 
                                                @input="plotForm.plot_image = $event.target.files[0]" 
                                                class="form-control" 
                                                id="plotImage"
                                                accept="image/png, image/jpg, image/jpeg"
                                                required
                                            >
                                        </div>
                                        <span class="help-block" style="color: red;">{{ errors.venture_id }}</span>
                                        <span class="help-block" style="color: red;">{{ errors.venture_plot_id }}</span>
                                        <span class="help-block" style="color: red;">{{ errors.plot_image }}</span>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">Upload Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script>
import { reactive, toRaw, ref  } from 'vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import VueNextSelect from 'vue-next-select'
import 'vue-next-select/dist/index.min.css'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


export default {
    name: 'EditPlot',
    components: {
        Head,
        Link,
        AuthenticatedLayout,
        VueDatePicker,    
        VueNextSelect
    },
    props: {
        errors: Object,
        venture_plot: {
            type: Object
        },
        all_customers: {
            type: Array,
            default: () => []
        },
        all_staffs: {
            type: Array
        }
    },
    created() {
        // console.log(this.$props.venture_plot)
        this.form.plot_id = this.$props.venture_plot.id;
        this.form.plot_name = this.$props.venture_plot.plot_name;

        this.plotForm.venture_id = this.$props.venture_plot.venture_id;
        this.plotForm.venture_plot_id = this.$props.venture_plot.plot_id;
        // this.form.plot_id = ;
        // console.log(this.$props.all_customers)
        // console.log(toRaw(this.$props.all_customers))
        // console.log(typeof this.$props.all_staffs)
        // this.allCustomers = toRaw(this.$props.all_customers)
        // console.log(JSON.parse(JSON.stringify(this.tickets)) )
        // this.isLoading = false
    },
    setup() {
        // const customer_id = ref();
        // const sale_date = ref();
        // const form = ref();
    },
    data(){
        return {
            form: {
                plot_id: '',
                plot_name: '',
                number_of_square_feet: '',
                total_price: '',
                customer_id: '',
                staff_id: '',
                sale_date: '',
                handover_date: ''
            },
            plotForm : this.$inertia.form({
                venture_id: '',
                venture_plot_id: '',
                plot_image: ''
            })
            // isLoading: true
        }
        
    },
    methods: {
        submit() {
            console.log(this.form);
            if(Object.keys(this.form.customer_id).length > 0){
                let formData = {
                    plot_id: this.form.plot_id,
                    plot_name: this.form.plot_name,
                    number_of_square_feet: this.form.number_of_square_feet,
                    total_price: this.form.total_price,
                    customer_id: this.form.customer_id.id,
                    staff_id: this.form.staff_id,
                    sale_date: this.formatDate(this.form.sale_date),
                    handover_date: this.formatDate(this.form.handover_date),
                }
                console.log(formData);
                const form = useForm({});
                form.post(route('venture-plots-update', formData))
            } else {
                alert('Customer Select is Requrired');
                
            }
            
        },
        formatDate(date) {
            if (date != null && date != '') {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) {
                    month = '0' + month;
                }
                if (day.length < 2) {
                    day = '0' + day;
                }

                return [year, month, day].join('-');
            } else {
                return '';
            }
        },
        ventureImageUpload(){
            // console.log(this.$props.venture_plot)
            console.log(this.plotForm)
            console.log(this.plotForm.plot_image)
            // console.log('called')
            // const form = useForm({});
            // const formData = new FormData();
            // formData.append('venture_id', this.$props.venture_plot.venture_id);
            // formData.append('plot_id', this.$props.venture_plot.plot_id);
            // // formData.append('plot_image', this.plotForm.plot_image);
            // // let formData = {
            // //     venture_id: this.$props.venture_plot.venture_id,
            // //     plot_id: this.$props.venture_plot.plot_id,
            // //     plot_image: this.plotForm.plot_image
            // // }
            // console.log(formData);
            this.plotForm.post(route('venture-plot-image-upload'));
        }
    }
    
}


// $(".select2").select2({
//     templateSelection: function (data, container) {
//         $(data.element).attr("data-custom-attribute", data.customValue);
//         return data.text;
//     },
// });
// console.log(props)
// const form = useForm({
//     plot_name: props.venture_plot.plot_name,
//     number_of_square_feet: props.venture_plot.number_of_square_feet,
//     total_price: props.venture_plot.total_price,
//     customer_id: '',
//     staff_id: '',
//     sale_date: '',
//     handover_date: '',
//     // all_customers: props.all_customers
// });

// function submit() {
    
// }

// function testClick() {
//     const swal = new VueSweetalert2();
//     // swal('Hello Vue world!!!')
//     console.log(swal.fire());
//     console.log('click')
// }
</script>


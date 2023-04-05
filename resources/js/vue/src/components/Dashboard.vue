<template>
    <main class="content">
        <div v-if="user.role == 'employee'">
            <EmployeeDashboard />
        </div>
        <div v-else>
            <AdminDashboard />
        </div>
        
    </main>
</template>








<script>
    import AdminDashboard from './AdminDashboard.vue';
    import EmployeeDashboard from './EmployeeDashboard.vue';

    export default {

        components: {
            AdminDashboard,
            EmployeeDashboard
        
        },
        
        data(){
            const userData = JSON.parse(localStorage.getItem('user'));

            return{
                user: userData,
            };
        },
    };
</script>


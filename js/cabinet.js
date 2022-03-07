var eventBus = new Vue();

Vue.component('autorisation', {
    template: '#autorisation',
    data: function(){
        return{
            email:"",
            emailNotEnter:false,              
            password: "",
            passwordNotEnter:false,    
            
            messageText:"",
            showMsgBlk:false,
            msgOk:true
        }
    }, 

    created: function() {
        eventBus.$on("kabinet-relogin", ()=>{
            this.rellogin(); 
        });
    },



    methods:{ 
       toRegister() {
        eventBus.$emit("chenge-state","register");
       },
       
       toPasRec() {
        eventBus.$emit("chenge-state","passrec");
       },

       rellogin() {
     
            document.cookie = "agriautorise=0; path=/; max-age=0";
            document.cookie = "agritoken=0; path=/; max-age=0";

            localStorage.removeItem('name'); 
            localStorage.removeItem('company_name'); 
            localStorage.removeItem('mail'); 
            localStorage.removeItem('phone'); 
            localStorage.removeItem('token'); 

            var params = new URLSearchParams();
            params.append('action', 'relogin');
            params.append('nonce', allAjax.nonce);
            params.append('email', this.email);

            axios.post(allAjax.ajaxurl, params);

            document.location.href = kabinet_page;
        },

       getAutorisation() {
            if (this.email == "") {this.emailNotEnter = true; return;};
            if (this.password == "") {this.passwordNotEnter = true; return;};

            var params = new URLSearchParams();
            params.append('action', 'user_autorization');
            params.append('nonce', allAjax.nonce);
            params.append('email', this.email);
            params.append('password', this.password);

            

            axios.post(allAjax.ajaxurl, params)
              .then((response) => {

                console.log(response);

                var d = new Date();
                d.setHours(d.getHours() + 5);

                document.cookie = "agriautorise="+response.data.mail+"; path=/; expires=" + d.toUTCString();
                document.cookie = "agritoken="+response.data.token+"; path=/; expires=" + d.toUTCString();

                localStorage.setItem('name', response.data.name); 
                localStorage.setItem('company_name', response.data.company_name); 
                localStorage.setItem('mail', response.data.mail); 
                localStorage.setItem('phone', response.data.phone); 
                localStorage.setItem('token', response.data.token); 

                eventBus.$emit("cabinet_innit");
                eventBus.$emit("chenge-state","kabinet");
              })
              .catch((error)  => {
                console.log(error.response.data);
                this.messageText = error.response.data.error;
                this.showMsgBlk = true;
                this.msgOk = false;
              });
       }
    }
});

Vue.component('registration', {
    template: '#registration',
    data: function(){
        return{
            name: "", 
            nameNotEnter:false,             
            email: "",
            emailNotEnter:false,         
            tel: "",         
            password: "",
            passwordNotEnter:false,
            
            messageText:"",
            showMsgBlk:false,
            msgOk:true
        }
    }, 
    methods:{ 
       toAutorization() {
        eventBus.$emit("chenge-state","autorization");
       },
       
       registerUser () {
            if (this.name == "") {this.nameNotEnter = true; return;};
            if (this.email == "") {this.emailNotEnter = true; return;};
            if (this.password == "") {this.passwordNotEnter = true; return;};

            var params = new URLSearchParams();
            params.append('action', 'user_register');
            params.append('nonce', allAjax.nonce);
            params.append('name', this.name);
            params.append('email', this.email);
            params.append('tel', this.tel);
            params.append('password', this.password);


            

            axios.post(allAjax.ajaxurl, params)
              .then((response) => {
                this.name = ""
                this.email = ""
                this.tel = ""
                this.password = ""
                
                this.messageText = "Вы успешно зарегистрировались. На емейл указанный при регистрации отправленно письмо с подтверждением регистрации, для использования личного кабинета перейдите по ссылке из письма.";
                this.showMsgBlk = true;
                this.msgOk = true;
              })
              .catch((error)  => {
                console.log("background-color: #1dc17b;");
                this.messageText = "Во время регистрации произошла ошибка возможно пользователь с таким e-mail уже зарегистрирован в системе!";
                this.showMsgBlk = true;
                this.msgOk = false;
              });
       }
    }
});

Vue.component('passrec', {
    template: '#passrec',
    data: function(){
        return{
            email:"",
            emailNotEnter:false,

            messageText:"",
            showMsgBlk:false,
            msgOk:true        
        }
    }, 
    methods:{ 
       toAutorization() {
        eventBus.$emit("chenge-state","autorization");
       },

       getPassRec() {
            this.showMsgBlk = false;
            if (this.email == "") {this.emailNotEnter = true;  return;};

            var params = new URLSearchParams();
            params.append('action', 'pass_rec');
            params.append('nonce', allAjax.nonce);
            params.append('email', this.email);
            
            
            axios.post(allAjax.ajaxurl, params)
              .then((response) => {
                this.messageText = "На вашу электронную почту высланны инструкции для восстановления пароля.";
                this.showMsgBlk = true;
                this.msgOk = true;

                console.log(response);
              })
              .catch((error)  => {
                this.messageText = "Пользователя с таким адресом не найдено!";
                this.showMsgBlk = true;
                this.msgOk = false;
                console.log(error);
              });
        
       } 
    }
});

Vue.component('kabinet', {
    template: '#kabinet',
    data: function(){
        return{
            UsserZakaz:[],
            name:"",      
            company:"",       
            email:""      
        }
    },
    mounted: function() {
        eventBus.$on("cabinet_innit", ()=>{
            this.getZakInfo(); 
            this.loadClientInfo(); 
        }); 
        

        if (getCookie("agriautorise") != undefined) {
            this.getZakInfo();
        }

        this.loadClientInfo();
         
    },
    
    methods: { 

        loadClientInfo() {
            this.name = localStorage.getItem("name");
            this.company = localStorage.getItem("company_name");
            this.email = localStorage.getItem("mail");
        },

        relogin() {
            eventBus.$emit("kabinet-relogin");
        },

        repeatZak (zakdetail, zaksumm) {
            var params = new URLSearchParams();
            params.append('action', 'send_cart');
            params.append('nonce', allAjax.nonce);
            params.append('bascet', JSON.stringify(zakdetail));
            params.append('bascetcount', zakdetail.length);
            params.append('bascetsumm', zaksumm);
            params.append('name', this.name);
            params.append('mail', this.email);
            params.append('comment', "Повторенный заказ. <br/><strong>Компания: </strong>"+this.company+" <br/>");

            axios.post(allAjax.ajaxurl, params)
              .then(function (response) {
                window.location.href = thencs_page;
              })
              .catch(function (error) {
                console.log(error);
                alert(error);
              }); 
        },

        getZakDetales(zknumber) {
            // console.log(zknumber); return;
            let params = new URLSearchParams();
            params.append('action', 'get_zak_detail');
            params.append('nonce', allAjax.nonce);
            params.append('zaknumber', zknumber);

            if (this.UsserZakaz[zknumber].zak_detale.length == 0) {
                axios.post(allAjax.ajaxurl, params)
                .then((response) => {
                    console.log(response.data); 
                    console.log(this.UsserZakaz[zknumber]); 
                    
                    this.UsserZakaz[zknumber].open_detale = !this.UsserZakaz[zknumber].open_detale;
                    this.UsserZakaz[zknumber].zak_detale = response.data;
                    
                })
                .catch((error)  => {
                    alert("Во время получения данных произошла ошибка! ");
                });
            } else {
                this.UsserZakaz[zknumber].open_detale = !this.UsserZakaz[zknumber].open_detale;
            }
        },

        getZakInfo() {
            let params = new URLSearchParams();
            params.append('action', 'get_zakinfo');
            params.append('nonce', allAjax.nonce);
            params.append('email', this.email);

            

            axios.post(allAjax.ajaxurl, params)
              .then((response) => {
                  console.log(response);
                  this.UsserZakaz  = response.data; 
              })
              .catch((error)  => {
                alert("Во время получения данных произошла ошибка!");
              });
        }
    }
});

let cabinet = new Vue({
    el:"#main_cabinet",
    
    data:{
        state:"",            
        showAutorize:true,
        showRegistration:false,
        showPassRec:false,
        showKabinet:false
    },
    
    created: function() {
        eventBus.$on("chenge-state", (state)=>{
            this.chengeState(state); 
        });
        
        window.addEventListener('focus', this.updateState);
        this.updateState();
    },


    methods:{

        updateState() {
            if (getCookie("agriautorise") != undefined) {
                this.chengeState("kabinet");
            } else {
                this.chengeState("autorization");
                
            }
        },

        chengeState(state) {
            console.log(state);
            this.showAutorize = false;
            this.showRegistration = false;
            this.showPassRec = false;
            this.showKabinet = false;

            if (state == "register") this.showRegistration = true;
            if (state == "autorization") this.showAutorize = true;
            if (state == "passrec") this.showPassRec = true;
            if (state == "kabinet") this.showKabinet = true;
        }
    }
});
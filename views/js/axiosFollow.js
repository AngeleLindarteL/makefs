/*--------------------------------Update data*/
let follow = document.querySelector("#follow-button");
let isFollow = follow.textContent;
let followersDataSect = document.querySelector('#followersSection');
followersData = parseInt(followersDataSect.textContent);
console.log(followersData);

follow.addEventListener("click", (e)=>{
    e.preventDefault();
    if(isFollow=="seguir"){
        
        let infoFollow = {
            "followerid" : followerid,
            "chefid" : chefid,
        };
        infoFollow = JSON.stringify(infoFollow);
        try{
            axios.post("../controllers/follow/follows.php",infoFollow).then(
                res => {
                    console.log(res);
                    if(res.status==200){
                        follow.textContent="siguiendo"
                        isFollow="siguiendo"
                        followersDataSect.textContent=followersData+1 ;
                        followersData += 1;
                    }
                }
            )
        }catch(e){
            console.log("Error al seguir al usuario, Detalles " + e);
        }

    }else{

        let infoFollow = {
            "followerid" : followerid,
            "chefid" : chefid,
        };
        infoFollow = JSON.stringify(infoFollow);
        try{
            axios.post("../controllers/follow/desfollow.php",infoFollow).then(
                res => {
                    console.log(res);
                    if(res.status==200){
                        follow.textContent="seguir"
                        isFollow="seguir"
                        followersDataSect.textContent=followersData-1 ;
                        followersData -= 1;
                    }
                }
            )
        }catch(e){
            console.log("Error al seguir al usuario, Detalles " + e);
        }
    }
})


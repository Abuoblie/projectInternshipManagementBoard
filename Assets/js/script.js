const page = document.getElementById('page').innerHTML;
const form = document.getElementById("signupForm");
const adds = document.getElementById("address")
const checkResult = document.createElement('p');
const enterprise = document.getElementById('location');
const locations = ['Ligne rue bb 855 ', '32 street 1450 Maffle', '3478 yui street 1450 Arbre', '321 chui street 1450 Villers-Saint-Amand', '32 hui street 1450 Mainvault', '11 lolo street 1450 Lanquesaint', '32 street 1450 Villers-Notre-Dame', '32 street 1450 Moulbaix', '32 street 1450 Gibecq', '32 street 1450 Ghislenghien', '15 q street 1450 Bouvignies', '32 z street 1450 Isières', 'ATH', 'Ostiches', 'Houtaing', 'Rebaix', 'Irchonwelz', 'Ormeignies']
const passwd = document.getElementById("pass1");
const confirm = document.getElementById("pass2");


if (page == 'addCompany.php') {

        for (let i = 0; i < locations.length; i++) {
                let cities = document.createElement("option");
                cities.value = locations[i];
                cities.text = locations[i];
                enterprise.appendChild(cities);
        }
}
else if (page == 'Signup.php') {

        passwd.addEventListener("keyup", () => {

                if (confirm.value.length != null && passwd.value != confirm.value) {
                        confirm.style.backgroundColor = "red"
                }
                else if (confirm.value.length != null && passwd.value == confirm.value) {

                        confirm.style.backgroundColor = "green";
                }
                else { confirm.style.backgroundColor = "white"; }

        })


        confirm.addEventListener("keyup", () => {

                if (passwd.value != confirm.value) {
                        confirm.style.backgroundColor = "red"
                }
                else if (passwd.value == confirm.value) {

                        confirm.style.backgroundColor = "green";
                }
                else { confirm.style.backgroundColor = "white"; }

        })


        function Validate() {

                if (passwd.value != confirm.value) {
                        checkResult.innerText = 'passwords did not match'
                        form.insertBefore(checkResult, adds)
                        return false;
                }
                checkResult.innerText = "";
                return true;
        }


}







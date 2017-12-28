 function rest(lienServer,lisid) {
    this.lienServer = lienServer;
    this.xhttp = new XMLHttpRequest();
    this.lisid = lisid;
    this.data = {};
    this.renderligne=
    function(data){
        document.getElementById(this.lisid).innerHTML += '<tr>';
            for (value in data) {
                document.getElementById(this.lisid).innerHTML += (value !== 'id')?'<td>'+value+'</td><td>'+data[value]+'</td>' : '';
            }
            document.getElementById(this.lisid).innerHTML += '<td><button type="button" onclick="viewuser('+data['id']+')">view</button></td><td><button type="button" onclick="appelfrom('+data['id']+')">edit</button></td><td><button type="button" onclick="deletuser('+data['id']+')">delete</button></td><td><button type="button" onclick="fromtask('+data['id']+')">nouvelle task</button></td>';
        document.getElementById(this.lisid).innerHTML += '</tr>';

    };

    this.views =
    function() {
        let self = this;
            this.xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('list').innerHTML = '';
                JSON.parse(this.responseText).forEach(function(value){
                self.renderligne(value)
            });
        }
        }
        this.xhttp.open("get", this.lienServer+"s", true)
        this.xhttp.send();
    };
    this.view =
    function(id){
        let self = this;

        this.xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(self.lisid).innerHTML = ' ';
                data = JSON.parse(this.responseText);
                for (a in data) {
                        self.renderligne(data[a]);
                }
        }
        };
                this.xhttp.open("get", this.lienServer+'/'+id, true);
                this.xhttp.send();
    };
    this.insert =
    function(data){
        let self = this;

        this.xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(self.lisid).innerHTML = '';
                self.renderligne(JSON.parse(this.responseText)[0])

        }
        };
                this.xhttp.open("post", this.lienServer, true);
                this.xhttp.send(JSON.stringify(data));
    };
    this.update=
    function(data, id){
        let self = this;
        this.xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(self.lisid).innerHTML = '';
                // value = JSON.parse(this.responseText)[0];
                //rest.renderligne(value)

        }
        };
                this.xhttp.open("put", this.lienServer+'/'+id, true);
                this.xhttp.send(JSON.stringify(data));
    };
    this.delete =
    function(id){
        this.xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        };
        }
        this.xhttp.open("DELETE", this.lienServer+'/'+id, true);
        this.xhttp.send();
    };
}

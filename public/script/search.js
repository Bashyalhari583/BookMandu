



const container = document.getElementById("list_box");
var childrens = [];

var childrens = Array.from(container.cloneNode(true).childNodes);

// childrens.forEach( (node)=>{
//     container.append(node);
// } )




var search_book = document.getElementById("search_book");
var genre = document.getElementById("genre");
var price_range = document.getElementById("price_range");

var list_template = document.getElementById('list_template');
var helper = document.getElementById('helper');
list_template.id = null;


function renderSearchData(datas= []) {

    container.innerHTML = "";
    // alert("Helo")
    // var rendered_ids = [];

    datas.forEach((each)=> {
        var child = list_template.cloneNode(true);
        child.style.display = "block";
        id = each['id'];

        // console.log(child)

        // if( rendered_ids.includes(id) ) return;
        // rendered_ids.push(id);

        var image = child.getElementsByClassName('book_image')[0];
        var link_view_book = child.getElementsByClassName('view_book')[0];
        var name = child.getElementsByClassName('book_name')[0];
        var author = child.getElementsByClassName('book_author')[0];
        var price = child.getElementsByClassName('book_price')[0];

        image.src = "/public/uploads/"+each['image_url'];
        
        link_view_book.href = "/product/"+each['id'];

        name.innerText = each['name']
        author.innerText = each['author']
        price.innerText = "Rs ."+each['price']

        container.appendChild(child);
    })//loop

}//render




var search = "";
var type = "";
var price = "";

// card_template, image,available_or_not,type,city_dis,link

function clearSearchIfNot(){
    if(search.length == 0 && type.length==0 && price ==0){
        container.innerHTML = '';
        helper.innerText = 'Latest Books';
        childrens.forEach(child => container.appendChild(child));
        return;
    }
    helper.innerText = 'Search Result';
    fetchData();
}//clear the search result

search_book.addEventListener('input', (e) => {
    search = e.target.value;
    clearSearchIfNot();
});

genre.addEventListener('change', (e) => {
    type = e.target.value;
    clearSearchIfNot();

});

price_range.addEventListener('change', (e) => {
    price = e.target.value;
    clearSearchIfNot();

});

async function fetchData() {

    const form = new FormData();
    form.append('search_book',search);
    form.append('category',type);
    form.append('price_range',price);

    try{

        const res = await fetch('/search_book',{method:'POST',body:form});
        if(!res.ok) throw new Error('Something went wrong while searching');
        const datas = await res.json();
        renderSearchData(datas);

    }
    catch(errr){
        // alert(errr);
    }//catch

}//fetchData

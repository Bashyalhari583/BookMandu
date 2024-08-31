<main class="m-0 md:m-20">

    <section
        class="home rounded-lg pl-10 pb-20 flex justify-left items-end bg-center bg-cover h-[calc(100vh-5rem)] bg-[url('/public/assets/images/default_the_image_should_feature_astylish_piece_of_furniture_02.png')] ">

        <div class="content flex flex-col gap-4">
            <h3 class="text-5xl text-blue-900 font-bold">Connecting Book Lovers
                <br /> Across Nepal
            </h3>
            <p class="text-gray-600">Join Bookmandu today and start buying and selling <br />books directly with
                other readers</p>
            <a href="#"
                class="btn w-fit hover:bg-blue-700 active:bg-blue-600 bg-blue-800 text-xl text-white py-2 px-4 rounded-lg" onclick="focusSearchBar()">Shop
                Now</a>
        </div>
    </section>

    <section class="productList p-2  mt-10 ">
        <h2 class="text-2xl mb-2 font-bold text-blue-800">Genres</h2>
        <p>Browse Our Extensive Collection of Books Across Different Genres.</p>

        <div id="categoryList" class="geners_icons flex-wrap mt-6 md:w-[100%] justify-between  gap-10 flex">

            <a href="/genre/fiction" class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20  rounded-full active:bg-gray-300">
                    <!-- <i class="drawer mr-3 text-4xl   text-gray-700 px-2  rounded-lg"
                        aria-hidden="true"></i> -->
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/Fiction.png" />
                </div>
                <span>Fiction</span>
            </a>

            <a href="/genre/finance" class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20 bg-gray-100 hover:bg-gray-200 hover:scale-105 transition-transform rounded-full active:bg-gray-300">
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/Finance.png" />
                </div>
                <span>Finance</span>
            </a>
            <a href="/genre/self_help" class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20 bg-gray-100 hover:bg-gray-200 hover:scale-105 transition-transform rounded-full active:bg-gray-300">
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/Selfhelp.png" />
                </div>
                <span>Self-help</span>
            </a>
            <a href="/genre/history"  class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20 bg-gray-100 hover:bg-gray-200 hover:scale-105 transition-transform rounded-full active:bg-gray-300">
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/History.png" />
                </div>
                <span>History</span>
            </a>
            <a href="/genre/biography" class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20 bg-gray-100 hover:bg-gray-200 hover:scale-105 transition-transform rounded-full active:bg-gray-300">
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/Biography.png" />
                </div>
                <span>Biography</span>
            </a>
            <a href="/genre/novels" class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20 bg-gray-100 hover:bg-gray-200 hover:scale-105 transition-transform rounded-full active:bg-gray-300">
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/Novel.png" />
                </div>
                <span>Novels</span>
            </a>
            <a href="/genre/uni_books" class="icontex cursor-pointer p-5 flex flex-col gap-2 items-center justify-center  w-[130px] border-2 border-solid border-[#ebedf3]  rounded-lg  hover:bg-white hover:scale-105 transition-transform hover:shadow-2xl">
                <div
                    class="circleIcon h-20 w-20 bg-gray-100 hover:bg-gray-200 hover:scale-105 transition-transform rounded-full active:bg-gray-300">
                    <img class="vector-group text-gray-700 rounded-lg " src="public/assets/images/Others.png" />
                </div>
                <span>Uni-Books</span>
            </a>
        </div>
    </section>
    <!-- <div id="booksContainer"></div> -->

    <section class="recently-added-books  mt-10 p-2">



        <div class="container bg-gray-200 p-4 rounded-lg">
            <div class="form-container">
                <form id="search" class=" flex flex-row gap-[250px]" method="POST" action="/search_book">
                <!-- id="search_book" -->
                    <input id="search_book" class="p-2 w-[800px] bg-white border-2 border-solid hover:border-blue-900 rounded-lg" type="text" placeholder="Search book " name="search_book">
                    <select id="genre" class="p-2 w-[500px] bg-white border-2 border-solid hover:border-blue-900 rounded-lg" name="category">
                    <option value="">Genre</option>
                    <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                        <?php } ?>
                        <!-- <option value="1">Fiction</option>
                        <option value="2">Finance</option> -->
                    </select>
                    <select id="price_range" class="p-2 w-[500px] bg-white border-2 border-solid hover:border-blue-900 rounded-lg" name="price_range">
                        <option value="">Price Range</option>
                        <option value="0-300">NRs.0 - NRs.300</option>
                        <option value="300-800">NRs. 300 - NRs.800</option>
                        <option value="800-2000">NRs.800 - NRs.2000</option>
                        <option value="2000-100000000">NRs.2000+</option>
                    </select>
                    <!-- <button class="p-2 mr-[400px] bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-lg" type="submit" name="submit">Search</button> -->
                </form>
            </div>
        </div>


        <li id="list_template" class="product hidden hover:bg-gray-100 hover:scale-105 transition-transform w-52 rounded-lg shadow-lg p-2">
            <a class="view_book" href="/product/>"> <img id="" src="/public/uploads/ prodcut_oage " class="rounded-lg book_image" alt="">
                <h4 id="" class="text-xl book_name">Book name </h4>
                <p id="" class="text-gray-500 book_author">Author </p>
                <p id="" class="text-sm book_price">Rs.Price </p>
            </a>
        </li>

        


        <h2 id="helper" class="text-2xl mb-2 my-10 font-bold text-blue-800">Latest books </h2>

        <ul id="list_box" class=" list flex gap-10 p-5 flex-wrap  ">
            <?php foreach ($books as $book) {  ?>
                <li class="product hover:bg-gray-100 hover:scale-105 transition-transform w-52 border-2 border-solid border-[#ebedf3] rounded-lg shadow-lg p-2">
                    <a href="/product/<?php echo $book['id'] ?>"> <img src="/public/uploads/<?php echo $book['image_url'] ?>" class="rounded-lg" alt="">
                        <h4 class="text-xl"><?php echo $book['name'] ?? '' ?></h4>
                        <p class="text-gray-500">By <?php echo $book['author'] ?? '' ?></p>
                        <p class="text-sm">Rs. <?php echo $book['price'] ?> </p>
                    </a>
                </li>
            <?php } ?>

        </ul>
        <div class="container py-10 px-10 mx-0 min-w-full flex flex-col items-center">
            <button class="button-load font-serif text-1xl text-white bg-blue-700 rounded-lg hover:bg-blue-800 active:bg-blue-900 text-center justify-center px-8 py-2 my-15 ">Load More</button>
        </div>
    </section>
</main>

<script>
    function show() {
        /* Access image by id and change 
        the display property to block*/
        document.getElementById('maindisplay')
            .style.display = "block";
    }

    function focusSearchBar() {
        const searchBar = document.getElementById('searchBar');
        searchBar.focus(); // Set focus to the search bar
    }
</script>

<script src="/public/script/search.js"></script>

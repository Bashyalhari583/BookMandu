

<div class="msg h-[calc(100vh-5rem)] m-20 p-20 border">

<h1 class="text-2xl font-bold">Profiles</h1>

<div class="showMesages flex flex-col gap-5  p-5 px-10 rounded-lg shadow-lg h-[70vh] w-[70%] border">



    <div id="message"  class="msges flex grow flex-col p-4 overflow-y-auto">
        <?php foreach($users as $c_user) { ?>
            <a href="/message/<?php echo $c_user['id'] ?>" class="cursor-pointer my-5 flex gap-4 items-center p-4 py-10 border shadow-lg rounded-lg hover:bg-gray-200">
                <img class="h-[40px] w-[40px] rounded-full" src="/public/uploads/<?php echo $c_user['profile_pic'] ?>" >
                <span class="name text-2xl font-bold">      <?php echo $c_user['name'] ?>        </span> 
                
        </a>
        <?php }?>
    </div>

 

   
</div>


</div>



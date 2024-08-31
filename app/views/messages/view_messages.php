<div class="msg h-[calc(100vh-5rem)] m-20 p-20 border">

    <h1 class="text-2xl font-bold">Messages</h1>

    <div class="showMesages flex flex-col gap-5  p-5 px-10 rounded-lg shadow-lg h-[70vh] w-[70%] border">

        <div class="div profile flex gap-4  items-center">
            <img class="h-[40px] w-[40px] rounded-full" src="/public/uploads/<?php echo $dest_user['profile_pic'] ?>" />
            <h1 class="text-2xl font-bold"><?php echo $dest_user['name'] ?? 'Unknown' ?></h1>
        </div>




        <div id="message" class="msges flex grow flex-col p-4 overflow-y-auto">
            <?php foreach ($messages as $message) { ?>
                <?php if($message['image']) {?>
                        <img class="w-[500px] mt-10 rounded-lg  <?php echo  $user_id != $message['sender_id'] ? 'self-start':'self-end' ?>" src="/public/uploads/<?php echo  $message['image'] ?>" >
                    <?php } else{?>
                <div class="p-4 my-4 rounded-lg  <?php echo  $user_id != $message['sender_id'] ? 'self-start bg-gray-200' : 'self-end bg-blue-600 text-white' ?>"><?php echo $message['content'] ?></div>
                        <?php }?>
            <?php } ?>
        </div>

        <div>
            <form id="form" action="/message/send" enctype="multipart/form-data" method="post" class="flex justify-center items-center gap-5">

            <label class="bg-blue-600 cursor-pointer text-white hover:bg-blue-700 active:bg-blue-800 rounded-lg px-4 py-1" for="image_file">Upload Image</label>

                <input class=" bg-gray-200 p-4 w-full rounded-lg" name="content" id="messageWrite" placeholder="Enter your messages">

                <input hidden class="bg-gray-200 p-4 w-full rounded-lg" name="receiver_id" id="message" value="<?php echo $other_id ?>"></input>
                <input hidden type="file"  accept="image/*" name="image" id="image_file">
                <input id="send" class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 py-2 px-4 rounded-lg cursor-pointer" type="submit" value="Send" />

            </form>
        </div>


    </div>


</div>

<script>
    const messageDiv = document.getElementById("message");
    const messageWrite = document.getElementById("messageWrite");

    messageDiv.scrollTop = messageDiv.scrollHeight;
    messageWrite.focus();



    const image_file = document.getElementById("image_file");
    const form = document.getElementById("form");
    const send = document.getElementById("send");
    
    image_file.addEventListener('change',(e)=>{
        const file = e.target.files[0];
        if(file) {
            form.submit();
        }//
    });


</script>
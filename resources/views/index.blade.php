<x-app>
    <div class="py-24 container mx-auto ">
        <form method="post" class="p-5" action="{{route('payment.send')}}">
            @csrf
            <div class="mb-2">
                <div class="font-bold mb-3">Card Type</div>
                <select  class=""  name="card_type" >
                 <option value="MASTERCARD">MASTERCARD</option>
                    <option value="VISA">VISA</option>
                </select>
            </div>
            <div class="mb-2">
                <div class="font-bold mb-3">Card number</div>
                <input type="text" class=" border-gray-200 placeholder-gray-300" type="text" name="card_number" placeholder="0000 0000 0000" />
            </div>
            <div class="mb-2">
                <div class="font-bold mb-3">Name</div>
                <input type="text" class=" border-gray-200 placeholder-gray-300" type="text" name="name" />
            </div>
            <div class="mb-2">
                <div class="font-bold mb-3">Expire Date</div>
                <input type="text" class=" border-gray-200 placeholder-gray-300" type="text" name="expire_date" placeholder="11/22" />
            </div>
            <div class="mb-2">
                <div class="font-bold mb-3">CVV</div>
                <input type="text" class=" border-gray-200 placeholder-gray-300" type="text" name="cvc"  />
            </div>
            <button class="mt-4 font-semibold rounded text-xl h-10 px-6 text-white bg-blue-500">
                Pay Now
            </button>
        </form>
    </div>
</x-app>
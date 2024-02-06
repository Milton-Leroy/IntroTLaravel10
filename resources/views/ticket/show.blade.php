<x-app-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">

        <h1 class="text-white">{{ $ticket->title  }}</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md  overflow-hidden sm:rounded-lg">

                <div class="text-white flex justify-between py-4">
                    <p>{{ $ticket->description }}</p>
                    <p>{{ $ticket->created_at->diffForHumans( ) }}</p>

                    @if($ticket->attachment)
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">View Attachment</a>
                    @endif

                </div>
                
                <div class="flex justify-between">

                    <div class="flex">

                        <form action="{{ route('tickets.edit',$ticket->id) }}" method="get">
                            @csrf

                            <x-primary-button>Edit</x-primary-button>

                        </form>

                        <form action="{{ route('tickets.destroy',$ticket->id) }}" method="post" class="ml-2">
                            @method('delete')
                            @csrf
                        
                         <x-primary-button>Delete</x-primary-button>

                        </form>
                    </div>

                    @if(auth()->user()->isAdmin)
                        <div class="flex">
                            <form action="{{ route('tickets.update',$ticket->id) }}" method="post">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="status" value="resolved">
                                <x-primary-button>Approve</x-primary-button>

                            </form>

<                           <form action="{{ route('tickets.update',$ticket->id) }}" method="post">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="status" value="rejected">
                                <x-primary-button class="ml-2 ">Reject</x-primary-button>

                            </form>
                            
                        </div>

                    @else
                        <p class="text-white">Status: {{ $ticket->status }}</p>

                    @endif
                </div>

        </div>

    </div>

</x-app-layout>
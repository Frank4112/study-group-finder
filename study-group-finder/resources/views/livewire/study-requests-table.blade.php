<div>
    <!-- Search + Filters -->
    <div class="flex justify-between mb-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Search by subject, course..."
            class="border rounded px-3 py-2 w-1/3"
        >

        <select wire:model.live="level" class="border rounded px-3 py-2">
            <option value="">Filter by Level</option>
            <option value="first_year">First Year</option>
            <option value="second_year">Second Year</option>
            <option value="third_year">Third Year</option>
            <option value="fourth_year">Fourth Year</option>
        </select>
    </div>

    <!-- Table -->
    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th wire:click="sortBy('subject')" class="border px-4 py-2 cursor-pointer">
                    Subject
                    @if($sortField === 'subject') ({{ strtoupper($sortDirection) }}) @endif
                </th>

                <th wire:click="sortBy('course')" class="border px-4 py-2 cursor-pointer">
                    Course
                    @if($sortField === 'course') ({{ strtoupper($sortDirection) }}) @endif
                </th>

                <th wire:click="sortBy('level')" class="border px-4 py-2 cursor-pointer">
                    Level
                    @if($sortField === 'level') ({{ strtoupper($sortDirection) }}) @endif
                </th>

                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($studyRequests as $req)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $req->subject }}</td>
                <td class="border px-4 py-2">{{ $req->course }}</td>

                <!-- Corrected Level Display -->
                <td class="border px-4 py-2">
                    {{ ucfirst(str_replace('_',' ', $req->level)) }}
                </td>

                <td class="border px-4 py-2">{{ $req->description }}</td>
                <td class="border px-4 py-2">{{ $req->user->name }}</td>

                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('study-requests.show', $req->id) }}"
                       class="text-green-600 hover:underline">View</a>

                    <a href="{{ route('study-requests.edit', $req->id) }}"
                       class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('study-requests.destroy', $req->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $studyRequests->links() }}
    </div>
</div>

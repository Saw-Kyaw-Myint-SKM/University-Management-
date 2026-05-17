<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Course') }}
            </h2>
            <a href="{{ route('courses.index') }}" class="flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('courses.update', $course) }}">
                        @csrf
                        @method('PUT')

                        {{-- Course Identity --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Course Details
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- Code --}}
                                <div>
                                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                        Course Code <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="code" name="code"
                                        value="{{ old('code', $course->code) }}"
                                        required
                                        placeholder="e.g. CS101"
                                        class="w-full px-4 py-3 border @error('code') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 font-mono uppercase"
                                        oninput="this.value = this.value.toUpperCase()">
                                    <p class="mt-1.5 text-xs text-gray-400">2–4 uppercase letters followed by 3–4 digits.</p>
                                    @error('code')
                                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Credits --}}
                                <div>
                                    <label for="credits" class="block text-sm font-medium text-gray-700 mb-2">
                                        Credit Hours <span class="text-red-500">*</span>
                                    </label>
                                    <select id="credits" name="credits"
                                        class="w-full px-4 py-3 border @error('credits') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                                        @foreach(range(1, 6) as $c)
                                            <option value="{{ $c }}" {{ old('credits', $course->credits) == $c ? 'selected' : '' }}>
                                                {{ $c }} {{ $c === 1 ? 'credit' : 'credits' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('credits')
                                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Name --}}
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Course Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $course->name) }}"
                                        required
                                        placeholder="e.g. Introduction to Programming"
                                        class="w-full px-4 py-3 border @error('name') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                                    @error('name')
                                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Department --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Academic Structure
                            </h3>

                            <div>
                                <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Department <span class="text-red-500">*</span>
                                </label>
                                <select id="department_id" name="department_id"
                                    class="w-full px-4 py-3 border @error('department_id') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200">
                                    <option value="">Select Department</option>
                                    @foreach($departments->groupBy(fn($d) => $d->faculty->name ?? 'No Faculty') as $facultyName => $depts)
                                        <optgroup label="{{ $facultyName }}">
                                            @foreach($depts as $department)
                                                <option value="{{ $department->id }}" {{ old('department_id', $course->department_id) == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Description
                            </h3>
                            <textarea id="description" name="description" rows="4"
                                placeholder="Brief overview of the course content and objectives..."
                                class="w-full px-4 py-3 border @error('description') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 resize-none">{{ old('description', $course->description) }}</textarea>
                            <p class="mt-1.5 text-xs text-gray-400">Optional. Max 1000 characters.</p>
                            @error('description')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('courses.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300">
                                Cancel
                            </a>
                            <button type="submit" class="flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-amber-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Update Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

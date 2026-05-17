<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Teacher Details') }}
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('teachers.edit', $teacher) }}" class="flex items-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-amber-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('teachers.index') }}" class="flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Card --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center mb-10">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-purple-600 rounded-3xl flex items-center justify-center text-white font-bold text-4xl mr-8 shadow-lg flex-shrink-0">
                            {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $teacher->user->name }}</h3>
                            <p class="text-lg text-gray-500 mt-1">{{ $teacher->user->email }}</p>
                            <div class="flex items-center gap-3 mt-3">
                                <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ $teacher->employee_number }}
                                </span>
                                @if($teacher->status === 'active')
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Personal Info --}}
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Full Name</span>
                                    <span class="text-gray-900 font-semibold">{{ $teacher->user->name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Email</span>
                                    <span class="text-gray-900 font-semibold">{{ $teacher->user->email }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Phone</span>
                                    <span class="text-gray-900 font-semibold">{{ $teacher->phone ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Professional Info --}}
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Professional Information
                            </h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-purple-200">
                                    <span class="text-gray-700 font-medium">Employee Number</span>
                                    <span class="text-gray-900 font-semibold">{{ $teacher->employee_number }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-purple-200">
                                    <span class="text-gray-700 font-medium">Department</span>
                                    <span class="text-gray-900 font-semibold">{{ $teacher->department->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-purple-200">
                                    <span class="text-gray-700 font-medium">Specialization</span>
                                    <span class="text-gray-900 font-semibold">{{ $teacher->specialization ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="lg:col-span-2 bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Address
                            </h4>
                            <p class="text-gray-900 text-lg leading-relaxed">{{ $teacher->address ?? 'No address provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enrolled Courses --}}
            @if($teacher->enrollments->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Assigned Courses
                        <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $teacher->enrollments->count() }}</span>
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($teacher->enrollments->unique('course_id') as $enrollment)
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <p class="font-semibold text-gray-900">{{ $enrollment->course->name ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $enrollment->course->code ?? '' }}</p>
                                <p class="text-xs text-gray-400 mt-2">{{ $enrollment->semester }} — {{ $enrollment->academic_year }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>

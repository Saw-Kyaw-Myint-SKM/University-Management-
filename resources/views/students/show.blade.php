<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Student Details') }}
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('students.edit', $student) }}" class="flex items-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-amber-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('students.index') }}" class="flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center mb-10">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center text-white font-bold text-4xl mr-8 shadow-lg">
                            {{ strtoupper(substr($student->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $student->user->name }}</h3>
                            <p class="text-lg text-gray-500 mt-1">{{ $student->user->email }}</p>
                            <span class="inline-flex items-center mt-3 px-4 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $student->student_number }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Full Name</span>
                                    <span class="text-gray-900 font-semibold">{{ $student->user->name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Email</span>
                                    <span class="text-gray-900 font-semibold">{{ $student->user->email }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Phone</span>
                                    <span class="text-gray-900 font-semibold">{{ $student->phone ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600 font-medium">Date of Birth</span>
                                    <span class="text-gray-900 font-semibold">{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('F j, Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Academic Information
                            </h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-blue-200">
                                    <span class="text-gray-700 font-medium">Student Number</span>
                                    <span class="text-gray-900 font-semibold">{{ $student->student_number }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-blue-200">
                                    <span class="text-gray-700 font-medium">Department</span>
                                    <span class="text-gray-900 font-semibold">{{ $student->department->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-2 bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Address
                            </h4>
                            <p class="text-gray-900 text-lg leading-relaxed">{{ $student->address ?? 'No address provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

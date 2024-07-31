<template>
    <!-- Mobile Sidebar Toggle -->
    <div class="md:hidden bg-gray-200 dark:bg-gray-800 w-auto">
        <button @click="toggleSidebar"
            class="p-2 m-2 bg-gray-200 text-gray-500 hover:text-gray-900 focus:outline-none focus:ring">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }" class="md:flex flex-col w-72 bg-gray-200 dark:bg-gray-800 ">
        <div class="flex flex-col flex-1">
            <nav class="flex-1 px-2 py-4 bg-gray-200 dark:bg-gray-800 rounded-md">

                <Link href="/addMessage" 
                      :class="{'bg-gray-700': activeLink === '/addMessage'}" 
                      @click="setActiveLink('/addMessage')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-3"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.875px" height="122.648px"
                    viewBox="0 0 122.875 122.648" enable-background="new 0 0 122.875 122.648" xml:space="preserve">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" :fill="fill"
                            d="M108.993,47.079c7.683-0.059,13.898,6.12,13.882,13.805 c-0.018,7.683-6.26,13.959-13.942,14.019L75.24,75.138l-0.235,33.73c-0.063,7.619-6.338,13.789-14.014,13.78 c-7.678-0.01-13.848-6.197-13.785-13.818l0.233-33.497l-33.558,0.235C6.2,75.628-0.016,69.448,0,61.764 c0.018-7.683,6.261-13.959,13.943-14.018l33.692-0.236l0.236-33.73C47.935,6.161,54.209-0.009,61.885,0 c7.678,0.009,13.848,6.197,13.784,13.818l-0.233,33.497L108.993,47.079L108.993,47.079z" />
                    </g>
                </svg>
                Add Message(s)
                </Link>

                <Link href="/allMessages" 
                      :class="{'bg-gray-700': activeLink === '/allMessages'}" 
                      @click="setActiveLink('/allMessages')"
                      class="flex items-center px-4 py-2 dark:text-white  hover:bg-gray-400">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-3"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="111.686px" height="122.879px"
                    viewBox="0 0 111.686 122.879" enable-background="new 0 0 111.686 122.879" xml:space="preserve">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" :fill="fill"
                            d="M53.332,93.189c-2.751,10.884-6.085,20.663-16.265,29.69 c19.462-4.978,34.49-15.041,45.517-29.69H53.332L53.332,93.189z M85.908,0H24.752C11.138,0,0,11.139,0,24.752v43.684 c0,13.614,11.138,24.753,24.752,24.753h61.156c13.615,0,24.754-11.139,24.754-24.753V24.752C110.662,11.139,99.523,0,85.908,0 L85.908,0z M26.221,35.117c5.599,0,10.141,4.542,10.141,10.141c0,5.599-4.542,10.141-10.141,10.141 c-5.6,0-10.141-4.542-10.141-10.141C16.08,39.658,20.621,35.117,26.221,35.117L26.221,35.117z M84.441,35.117 c5.6,0,10.141,4.542,10.141,10.141c0,5.599-4.541,10.141-10.141,10.141s-10.141-4.542-10.141-10.141 C74.301,39.658,78.842,35.117,84.441,35.117L84.441,35.117z M55.331,35.117c5.599,0,10.142,4.542,10.142,10.141 c0,5.599-4.543,10.141-10.142,10.141c-5.6,0-10.141-4.542-10.141-10.141C45.19,39.658,49.731,35.117,55.331,35.117L55.331,35.117z" />
                    </g>
                </svg>


                All Messages
                </Link>

                <Link href="/sentMessages" 
                      :class="{'bg-gray-700': activeLink === '/sentMessages'}" 
                      @click="setActiveLink('/sentMessages')"
                      class="flex items-center px-4 py-2 dark:text-white  hover:bg-gray-400">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-3"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.877px" height="101.052px"
                    viewBox="0 0 122.877 101.052" enable-background="new 0 0 122.877 101.052" xml:space="preserve">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" :fill="fill"
                            d="M4.43,63.63c-2.869-2.755-4.352-6.42-4.427-10.11c-0.074-3.689,1.261-7.412,4.015-10.281 c2.752-2.867,6.417-4.351,10.106-4.425c3.691-0.076,7.412,1.255,10.283,4.012l24.787,23.851L98.543,3.989l1.768,1.349l-1.77-1.355 c0.141-0.183,0.301-0.339,0.479-0.466c2.936-2.543,6.621-3.691,10.223-3.495V0.018l0.176,0.016c3.623,0.24,7.162,1.85,9.775,4.766 c2.658,2.965,3.863,6.731,3.662,10.412h0.004l-0.016,0.176c-0.236,3.558-1.791,7.035-4.609,9.632l-59.224,72.09l0.004,0.004 c-0.111,0.141-0.236,0.262-0.372,0.368c-2.773,2.435-6.275,3.629-9.757,3.569c-3.511-0.061-7.015-1.396-9.741-4.016L4.43,63.63 L4.43,63.63z" />
                    </g>
                </svg>

                Sent Messages
                </Link>

                <Link href="/scheduledMessages" 
                      :class="{'bg-gray-700': activeLink === '/scheduledMessages'}" 
                      @click="setActiveLink('/scheduledMessages')"
                      class="flex items-center px-4 py-2 dark:text-white  hover:bg-gray-400">
                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-3"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.88"
                    style="enable-background:new 0 0 122.88 122.88" xml:space="preserve">
                    <g>
                        <path class="st0" fill-rule="evenodd" clip-rule="evenodd" :fill="fill"
                            d="M61.44,0c33.93,0,61.44,27.51,61.44,61.44c0,33.93-27.51,61.44-61.44,61.44C27.51,122.88,0,95.37,0,61.44 C0,27.51,27.51,0,61.44,0L61.44,0z M52.92,30.52h7.51c1.37,0,2.5,1.13,2.5,2.5v28.94h26.41c1.38,0,2.5,1.13,2.5,2.5v7.51 c0,1.38-1.13,2.5-2.5,2.5H50.41V33.02C50.41,31.64,51.54,30.52,52.92,30.52L52.92,30.52z M61.44,13.95 c26.23,0,47.49,21.26,47.49,47.49c0,26.23-21.26,47.49-47.49,47.49c-26.23,0-47.49-21.26-47.49-47.49 C13.95,35.22,35.21,13.95,61.44,13.95L61.44,13.95z" />
                    </g>
                </svg>

                Scheduled Messages
                </Link>

                <Link href="/failedMessages" 
                      :class="{'bg-gray-700': activeLink === '/failedMessages'}" 
                      @click="setActiveLink('/failedMessages')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-3"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="121.31px" height="122.876px"
                    viewBox="0 0 121.31 122.876" enable-background="new 0 0 121.31 122.876" xml:space="preserve">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" :fill="fill"
                            d="M90.914,5.296c6.927-7.034,18.188-7.065,25.154-0.068 c6.961,6.995,6.991,18.369,0.068,25.397L85.743,61.452l30.425,30.855c6.866,6.978,6.773,18.28-0.208,25.247 c-6.983,6.964-18.21,6.946-25.074-0.031L60.669,86.881L30.395,117.58c-6.927,7.034-18.188,7.065-25.154,0.068 c-6.961-6.995-6.992-18.369-0.068-25.397l30.393-30.827L5.142,30.568c-6.867-6.978-6.773-18.28,0.208-25.247 c6.983-6.963,18.21-6.946,25.074,0.031l30.217,30.643L90.914,5.296L90.914,5.296z" />
                    </g>
                </svg>
                Failed Messages
                </Link>

                <Link href="/pendingMessages" 
                      :class="{'bg-gray-700': activeLink === '/pendingMessages'}" 
                      @click="setActiveLink('/pendingMessages')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                      <svg class="w-5 h-5 mx-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="105.762px" height="122.88px" viewBox="0 0 105.762 122.88" enable-background="new 0 0 105.762 122.88" xml:space="preserve"><g><path :fill="fill" d="M86.27,112.663c0.195-19.858-6.947-33.132-16.682-39.914c-3.773-2.629-7.914-4.284-12.133-4.97 c-4.236-0.685-8.583-0.408-12.747,0.828c-13.737,4.082-25.458,18.735-25.215,44.055L86.27,112.663L86.27,112.663L86.27,112.663z M19.977,19.522h65.814c0.346-2.922,0.514-6.025,0.479-9.307H19.496C19.462,13.498,19.629,16.6,19.977,19.522L19.977,19.522z M0.91,112.663h9.567c-0.256-27.544,12.171-44.634,27.549-51.198c-15.389-6.566-27.821-23.676-27.549-51.252L0.91,10.214 c-0.501,0-0.909-0.46-0.909-1.025L0,1.024C0,0.46,0.409,0,0.91,0h103.942c0.5,0,0.91,0.46,0.91,1.024v8.164 c0,0.564-0.41,1.025-0.91,1.025h-9.57c0.225,23.213-8.58,39.037-20.545,47.375c-2.188,1.522-4.543,2.832-6.994,3.873 c2.447,1.049,4.809,2.355,6.992,3.88c11.955,8.332,20.756,24.138,20.545,47.32l9.572,0.001c0.5,0,0.91,0.463,0.91,1.027v8.162 c0,0.564-0.41,1.027-0.91,1.027H0.91c-0.501,0-0.909-0.463-0.909-1.027v-8.162C0.001,113.126,0.41,112.663,0.91,112.663 L0.91,112.663z"/></g></svg>
                Pending Messages
                </Link>


                <Link href="/myConnection" 
                      :class="{'bg-gray-700': activeLink === '/myConnection'}" 
                      @click="setActiveLink('/myConnection')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" class="w-5 h-5 mx-3"
                    text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd"
                    clip-rule="evenodd" viewBox="0 0 510 512.459">
                    <path :fill="fill"
                        d="M435.689 74.468C387.754 26.471 324 .025 256.071 0 116.098 0 2.18 113.906 2.131 253.916c-.024 44.758 11.677 88.445 33.898 126.946L0 512.459l134.617-35.311c37.087 20.238 78.85 30.891 121.345 30.903h.109c139.949 0 253.88-113.917 253.928-253.928.024-67.855-26.361-131.645-74.31-179.643v-.012zm-179.618 390.7h-.085c-37.868-.011-75.016-10.192-107.428-29.417l-7.707-4.577-79.886 20.953 21.32-77.889-5.017-7.987c-21.125-33.605-32.29-72.447-32.266-112.322.049-116.366 94.729-211.046 211.155-211.046 56.373.025 109.364 22.003 149.214 61.903 39.853 39.888 61.781 92.927 61.757 149.313-.05 116.377-94.728 211.058-211.057 211.058v.011zm115.768-158.067c-6.344-3.178-37.537-18.52-43.358-20.639-5.82-2.119-10.044-3.177-14.27 3.178-4.225 6.357-16.388 20.651-20.09 24.875-3.702 4.238-7.403 4.762-13.747 1.583-6.343-3.178-26.787-9.874-51.029-31.487-18.86-16.827-31.597-37.598-35.297-43.955-3.702-6.355-.39-9.789 2.775-12.943 2.849-2.848 6.344-7.414 9.522-11.116s4.225-6.355 6.343-10.581c2.12-4.238 1.06-7.937-.522-11.117-1.584-3.177-14.271-34.409-19.568-47.108-5.151-12.37-10.385-10.69-14.269-10.897-3.703-.183-7.927-.219-12.164-.219s-11.105 1.582-16.925 7.939c-5.82 6.354-22.209 21.709-22.209 52.927 0 31.22 22.733 61.405 25.911 65.642 3.177 4.237 44.745 68.318 108.389 95.812 15.135 6.538 26.957 10.446 36.175 13.368 15.196 4.834 29.027 4.153 39.96 2.52 12.19-1.825 37.54-15.353 42.824-30.172 5.283-14.818 5.283-27.529 3.701-30.172-1.582-2.641-5.819-4.237-12.163-7.414l.011-.024z" />
                </svg>
                My Connection
                </Link>

                <Link href="/APIs" 
                      :class="{'bg-gray-700': activeLink === '/APIs'}" 
                      @click="setActiveLink('/APIs')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                      <svg class="w-5 h-5 mx-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 115.28 122.88" style="enable-background:new 0 0 115.28 122.88" xml:space="preserve"><g><path :fill="fill" class="st0" d="M25.38,57h64.88V37.34H69.59c-2.17,0-5.19-1.17-6.62-2.6c-1.43-1.43-2.3-4.01-2.3-6.17V7.64H8.15 c-0.18,0-0.32,0.09-0.41,0.18C7.59,7.92,7.55,8.05,7.55,8.24v106.45c0,0.14,0.09,0.32,0.18,0.41c0.09,0.14,0.28,0.18,0.41,0.18 l81.51,0c0.18,0,0.17-0.09,0.27-0.18c0.14-0.09,0.33-0.28,0.33-0.41v-11.16H25.38c-4.14,0-7.56-3.4-7.56-7.56V64.55 C17.82,60.4,21.22,57,25.38,57L25.38,57L25.38,57z M50.95,88.6h-8.71l-1.25,4.1h-7.85l9.36-24.88h8.41l9.32,24.88h-8.05L50.95,88.6 L50.95,88.6z M49.32,83.22l-2.72-8.94l-2.73,8.94H49.32L49.32,83.22z M62.7,67.82h12.79c2.79,0,4.87,0.66,6.26,1.99 c1.38,1.33,2.08,3.21,2.08,5.66c0,2.51-0.76,4.48-2.27,5.9c-1.51,1.42-3.82,2.13-6.93,2.13h-4.22v9.21H62.7V67.82L62.7,67.82z M70.41,78.46h1.89c1.49,0,2.54-0.26,3.14-0.78c0.6-0.52,0.9-1.18,0.9-1.98c0-0.78-0.26-1.44-0.79-1.99 c-0.52-0.54-1.51-0.82-2.95-0.82h-2.2V78.46L70.41,78.46z M88.2,67.82h7.71V92.7H88.2V67.82L88.2,67.82z M97.79,57h9.93 c4.16,0,7.56,3.41,7.56,7.56v31.42c0,4.15-3.41,7.56-7.56,7.56h-9.93v13.55c0,1.61-0.64,3.04-1.7,4.1c-1.06,1.06-2.49,1.7-4.1,1.7 l-86.18,0c-1.61,0-3.04-0.65-4.1-1.7c-1.06-1.06-1.7-2.49-1.7-4.1V5.85c0-1.61,0.65-3.04,1.7-4.1c1.06-1.06,2.53-1.7,4.1-1.7h58.72 C64.66,0,64.8,0,64.94,0c0.65,0,1.29,0.28,1.75,0.69h0.09c0.09,0.05,0.14,0.09,0.23,0.18l30,30.36c0.51,0.51,0.88,1.2,0.88,1.98 c0,0.23-0.05,0.41-0.09,0.65L97.79,57L97.79,57L97.79,57z M67.52,27.97V8.94l21.43,21.7H70.19c-0.74,0-1.38-0.32-1.89-0.78 C67.84,29.4,67.52,28.71,67.52,27.97L67.52,27.97z"/></g></svg>
                APIs
                </Link>

                <Link href="/stats" 
                      :class="{'bg-gray-700': activeLink === '/stats'}" 
                      @click="setActiveLink('/stats')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                <svg class="w-5 h-5 mx-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 87.46"
                    style="enable-background:new 0 0 122.88 87.46" xml:space="preserve">
                    <g>
                        <path :fill="fill"
                            d="M2.17,87.46c-1.2,0-2.17-0.91-2.17-2.04c0-1.13,0.97-2.04,2.17-2.04h9.16V20.59c0-0.65,0.27-1.25,0.7-1.68 c0.44-0.44,1.03-0.71,1.68-0.71h13.02c0.66,0,1.25,0.27,1.68,0.71c0.43,0.43,0.7,1.03,0.7,1.68v62.78h9.69V38.8 c0-0.65,0.27-1.24,0.7-1.68l0,0l0,0l0,0c0.43-0.43,1.03-0.7,1.67-0.7h13.02c0.67,0,1.26,0.27,1.68,0.7c0.43,0.43,0.7,1.04,0.7,1.68 v44.57h9.69V2.38c0-0.65,0.27-1.24,0.7-1.68l0,0l0,0C67.42,0.27,68.01,0,68.67,0h13.02c0.66,0,1.25,0.27,1.68,0.7l0,0 c0.43,0.43,0.7,1.04,0.7,1.68v80.99h9.69V25.8c0-0.65,0.27-1.25,0.7-1.68l0,0c0.43-0.43,1.03-0.7,1.69-0.7h13.02 c0.66,0,1.26,0.27,1.68,0.7c0.43,0.43,0.7,1.03,0.7,1.68v57.58h9.16c1.2,0,2.17,0.91,2.17,2.04c0,1.13-0.97,2.04-2.17,2.04h-11.27 c-0.02,0-0.04,0-0.06,0H95.94c-0.02,0-0.04,0-0.06,0H81.96c-0.02,0-0.04,0-0.06,0H68.46c-0.02,0-0.04,0-0.06,0H54.49 c-0.02,0-0.04,0-0.06,0H40.98c-0.02,0-0.04,0-0.06,0H27l-0.06,0H13.5l-0.06,0H2.17L2.17,87.46z M24.77,22.55h-9.1v60.56h9.1V22.55 L24.77,22.55z M52.25,40.76h-9.1v42.35h9.1V40.76L52.25,40.76z M79.73,4.34h-9.1v78.77h9.1V4.34L79.73,4.34z M107.2,27.76h-9.1 v55.36h9.1V27.76L107.2,27.76z" />
                    </g>
                </svg>
                Statistics
                </Link>

                <Link :href="route('profile.show')" 
                      :class="{'bg-gray-700': activeLink === 'profile.show'}" 
                      @click="setActiveLink('profile.show')"
                      class="flex items-center px-4 py-2 mt-4 dark:text-white  hover:bg-gray-400">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-3"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.88px" height="122.878px"
                    viewBox="0 0 122.88 122.878" enable-background="new 0 0 122.88 122.878" xml:space="preserve">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" :fill="fill"
                            d="M101.589,14.7l8.818,8.819c2.321,2.321,2.321,6.118,0,8.439l-7.101,7.101 c1.959,3.658,3.454,7.601,4.405,11.752h9.199c3.283,0,5.969,2.686,5.969,5.968V69.25c0,3.283-2.686,5.969-5.969,5.969h-10.039 c-1.231,4.063-2.992,7.896-5.204,11.418l6.512,6.51c2.321,2.323,2.321,6.12,0,8.44l-8.818,8.819c-2.321,2.32-6.119,2.32-8.439,0 l-7.102-7.102c-3.657,1.96-7.601,3.456-11.753,4.406v9.199c0,3.282-2.685,5.968-5.968,5.968H53.629 c-3.283,0-5.969-2.686-5.969-5.968v-10.039c-4.063-1.232-7.896-2.993-11.417-5.205l-6.511,6.512c-2.323,2.321-6.12,2.321-8.441,0 l-8.818-8.818c-2.321-2.321-2.321-6.118,0-8.439l7.102-7.102c-1.96-3.657-3.456-7.6-4.405-11.751H5.968 C2.686,72.067,0,69.382,0,66.099V53.628c0-3.283,2.686-5.968,5.968-5.968h10.039c1.232-4.063,2.993-7.896,5.204-11.418l-6.511-6.51 c-2.321-2.322-2.321-6.12,0-8.44l8.819-8.819c2.321-2.321,6.118-2.321,8.439,0l7.101,7.101c3.658-1.96,7.601-3.456,11.753-4.406 V5.969C50.812,2.686,53.498,0,56.78,0h12.471c3.282,0,5.968,2.686,5.968,5.969v10.036c4.064,1.231,7.898,2.992,11.422,5.204 l6.507-6.509C95.471,12.379,99.268,12.379,101.589,14.7L101.589,14.7z M61.44,36.92c13.54,0,24.519,10.98,24.519,24.519 c0,13.538-10.979,24.519-24.519,24.519c-13.539,0-24.519-10.98-24.519-24.519C36.921,47.9,47.901,36.92,61.44,36.92L61.44,36.92z" />
                    </g>
                </svg>
                Settings
                </Link>

            </nav>
        </div>
    </div>

</template>

<script setup>
import { ref, reactive } from 'vue';
import { Link } from '@inertiajs/vue3';
import $ from 'jquery';

const sidebarOpen = ref(false);
var activeLink = ref(null);

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const setActiveLink = (link) => {
            activeLink = link;
        }

var fill = ref(document.body.classList.contains('dark') ? 'white' : 'black');

$(document.body).on('change_class_list', function(){
    fill.value = document.body.classList.contains('dark') ? 'white' : 'black';
    if (fill.value == 'white'){
        
        $(document.body).removeClass('bg-gray-200');
        $('.content-wrapper').removeClass('bg-gray-200');
        $(document.body).addClass('bg-gray-800');
        $('.content-wrapper').addClass('bg-gray-800');
        
            }
    else{
        $(document.body).removeClass('bg-gray-800');
        $('.content-wrapper').removeClass('bg-gray-800');
        $(document.body).addClass('bg-gray-200');
        $('.content-wrapper').addClass('bg-gray-200');
            }
});

</script>
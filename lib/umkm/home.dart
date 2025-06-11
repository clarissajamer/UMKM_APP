import 'package:flutter/material.dart';

class Home extends StatefulWidget {
  const Home({super.key});

  @override
  State<Home> createState() => _HomeState();
}

class _HomeState extends State<Home> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 242, 241, 239),
      bottomNavigationBar: ClipRRect(
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(24),
          topRight: Radius.circular(24),
        ),
        child: BottomNavigationBar(
          backgroundColor: const Color.fromARGB(255, 237, 160, 35), // Warna latar belakang navbar
          selectedItemColor: const Color.fromARGB(255, 111, 8, 8),
          unselectedItemColor: const Color.fromARGB(255, 111, 8, 8),
          items: const [
            BottomNavigationBarItem(icon: Icon(Icons.home), label: ''),
            BottomNavigationBarItem(icon: Icon(Icons.timer), label: ''),
            BottomNavigationBarItem(icon: Icon(Icons.person), label: ''),
          ],
        ),
      ),

      body: SafeArea(
        child: ListView(
          padding: const EdgeInsets.all(16),
          children: [
            
            // Search bar
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              decoration: BoxDecoration(
                color: const Color(0xFFF6EFD9),
                borderRadius: BorderRadius.circular(30),
              ),
              child: Row(
                children: const [
                  Expanded(
                    child: TextField(
                      decoration: InputDecoration(
                        hintText: "Search...",
                        border: InputBorder.none,
                      ),
                    ),
                  ),
                  Icon(Icons.search, color: Color.fromARGB(255, 131, 19, 5)),
                ],
              ),
            ),
            const SizedBox(height: 16),

            // Promo banner
            Container(
              height: 200,
              width: 400,
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: const Color.fromARGB(255, 247, 198, 52),
                borderRadius: BorderRadius.circular(16),
              ),
            ),
            const SizedBox(height: 16),

            // Produk vertikal lagi
            for (int i = 0; i < 3; i++)
              Container(
                margin: const EdgeInsets.only(bottom: 12),
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(16),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.3),
                      offset: const Offset(0, 2),
                      blurRadius: 4,
                      spreadRadius: 1,
                    ),
                  ],
                ),
                child: Row(
                  children: [
                    Image.asset('assets/chatime.png', width: 60, height: 60),
                    const SizedBox(width: 8),
                    const Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'chatime',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                          Text('es krim'),
                          SizedBox(height: 4),
                          Text('Rp.10.000'),
                        ],
                      ),
                    ),
                    const Text("lihat gerai"),
                    const Icon(Icons.arrow_forward_ios, size: 14),
                  ],
                ),
              ),
            const SizedBox(height: 16),

            // 2 item gridSizedBox(
            SizedBox(
              height: 220,
              child: ListView.builder(
                scrollDirection: Axis.horizontal,
                itemCount: 6,
                itemBuilder: (context, index) {
                  return Container(
                    width: 200,
                    margin: EdgeInsets.only(right: 16),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.3),
                          offset: Offset(2, 2),
                          blurRadius: 4,
                          spreadRadius: 1,
                        ),
                      ],
                      image: DecorationImage(
                        image: AssetImage(
                          'assets/salad.png',
                        ), // Ganti sesuai item
                        fit: BoxFit.cover,
                      ),
                    ),
                    child: Stack(
                      children: [
                        Align(
                          alignment: Alignment.bottomCenter,
                          child: Container(
                            height: 60,
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.only(
                                bottomLeft: Radius.circular(20),
                                bottomRight: Radius.circular(20),
                              ),
                            ),
                            padding: EdgeInsets.all(8),
                            child: Center(
                              child: Text(
                                'Salad Segar ${index + 1}', // Nama item bisa dinamis
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 14,
                                ),
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),
                  );
                },
              ),
            ),

            const SizedBox(height: 16),

            // Produk vertikal lagi
            for (int i = 0; i < 3; i++)
              Container(
                margin: const EdgeInsets.only(bottom: 12),
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(16),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.3),
                      offset: const Offset(0, 2),
                      blurRadius: 4,
                      spreadRadius: 1,
                    ),
                  ],
                ),
                child: Row(
                  children: [
                    Image.asset('assets/chatime.png', width: 60, height: 60),
                    const SizedBox(width: 8),
                    const Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'chatime',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                          Text('es krim'),
                          SizedBox(height: 4),
                          Text('Rp.10.000'),
                        ],
                      ),
                    ),
                    const Text("lihat gerai"),
                    const Icon(Icons.arrow_forward_ios, size: 14),
                  ],
                ),
              ),
          ],
        ),
      ),
    );
  }
}

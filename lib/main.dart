import 'package:flutter/material.dart';
import 'package:umkm_app/umkm/home.dart';
import 'package:umkm_app/umkm/splash.dart';

void main() {
  runApp(const MainApp());
}

class MainApp extends StatelessWidget {
  const MainApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Splash(), // Ganti dengan Splash()
    );
  }
}

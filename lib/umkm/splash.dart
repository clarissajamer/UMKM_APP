import 'package:flutter/material.dart';
import 'package:gap/gap.dart';

class Splash extends StatefulWidget {
  const Splash({super.key});

  @override
  State<Splash> createState() => _SplashState();
}

class _SplashState extends State<Splash> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        fit: StackFit.expand,
        children: [
          // Background image
          Image.asset(
            'assets/bg.png', // Ganti dengan path asset kamu
            fit: BoxFit.cover,
          ),
          // Layered content: logo dan teks
          Column(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              const SizedBox(height: 40), // Jarak dari atas jika perlu
              Image.asset('assets/logo.png', width: 180, height: 180),
              const Padding(
                padding: EdgeInsets.only(bottom: 80),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

// ignore_for_file: use_build_context_synchronously, library_private_types_in_public_api

import 'package:flutter/material.dart';
import '../services/auth_service.dart';
import 'dashboard_screen.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();
  final AuthService authService = AuthService();

  void login() async {
    bool success = await authService.login(emailController.text, passwordController.text);
    if (success) {
      Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) => DashboardScreen()));
    } else {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text("Login falhou!")));
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("Login")),
      body: Padding(
        padding: EdgeInsets.all(16),
        child: Column(
          children: [
            TextField(controller: emailController, decoration: InputDecoration(labelText: "Email")),
            TextField(controller: passwordController, decoration: InputDecoration(labelText: "Senha"), obscureText: true),
            SizedBox(height: 20),
            ElevatedButton(onPressed: login, child: Text("Entrar")),
          ],
        ),
      ),
    );
  }
}
